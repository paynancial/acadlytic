<?php
/**
 * Workspace authentication service (secure-ready, disabled by default).
 *
 * This release ships the public login experience only. Authentication stays
 * off (config auth.enabled = false) until the CMS/auth phase provisions the
 * users table, mail delivery and the post-login workspaces. When disabled,
 * the service never pretends to sign anyone in.
 *
 * What is already implemented for that phase:
 *  - password_verify() against password_hash() hashes, with transparent
 *    rehashing when the algorithm/cost changes;
 *  - constant-work lookups so unknown emails and wrong passwords take the
 *    same time and return the same message (no account enumeration);
 *  - per email+IP and per IP throttling with lockout windows;
 *  - session ID regeneration on login and full teardown on logout;
 *  - an audit trail of authentication events (database table auth_audit);
 *  - an MFA hand-off state for accounts that have a second factor enabled.
 *
 * Schema: database/schema.sql. Architecture: docs/AUTH_ARCHITECTURE.md.
 */
declare(strict_types=1);

final class AuthResult
{
    public const OK = 'ok';
    public const INVALID = 'invalid';
    public const LOCKED = 'locked';
    public const UNAVAILABLE = 'unavailable';
    public const MFA_REQUIRED = 'mfa_required';

    public function __construct(public readonly string $status, public readonly ?array $user = null)
    {
    }
}

final class AuthService
{
    /** Destination per workspace once the authenticated areas exist. */
    public const WORKSPACE_HOME = [
        'institution' => '/admin/',
        'faculty'     => '/faculty/',
        'student'     => '/student/',
        'parent'      => '/student/',
        'partner'     => '/partner/',
    ];

    public static function enabled(): bool
    {
        return (bool) acad_config('auth.enabled') && acad_db() !== null;
    }

    public function attempt(string $email, string $password, string $workspace = ''): AuthResult
    {
        $email = mb_strtolower(trim($email));
        $ipKey = acad_client_fingerprint();
        $pairKey = hash('sha256', $email . '|' . $ipKey);
        $max = (int) acad_config('auth.max_attempts');
        $window = (int) acad_config('auth.lockout_secs');

        if (acad_rate_limited('auth-pair', $pairKey, $max) || acad_rate_limited('auth-ip', $ipKey, $max * 4)) {
            $this->audit('login_locked', null, $email);
            return new AuthResult(AuthResult::LOCKED);
        }
        if (!self::enabled()) {
            return new AuthResult(AuthResult::UNAVAILABLE);
        }

        $stmt = acad_db()->prepare('SELECT id, email, name, password_hash, role, status, mfa_enabled FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch() ?: null;

        // Verify against a dummy hash when the user is unknown so response
        // time does not reveal whether the account exists.
        $hash = $user['password_hash'] ?? password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);
        $valid = password_verify($password, $hash) && $user !== null && $user['status'] === 'active';

        if (!$valid) {
            acad_rate_limit('auth-pair', $pairKey, $max, $window);
            acad_rate_limit('auth-ip', $ipKey, $max * 4, $window);
            $this->audit('login_failed', $user['id'] ?? null, $email);
            return new AuthResult(AuthResult::INVALID);
        }

        if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
            $upd = acad_db()->prepare('UPDATE users SET password_hash = :h WHERE id = :id');
            $upd->execute([':h' => password_hash($password, PASSWORD_DEFAULT), ':id' => $user['id']]);
        }

        acad_session_start();
        session_regenerate_id(true);
        unset($user['password_hash']);

        if ((int) $user['mfa_enabled'] === 1) {
            $_SESSION['auth_pending'] = ['uid' => (int) $user['id'], 'at' => time(), 'workspace' => $workspace];
            $this->audit('login_mfa_challenge', (int) $user['id'], $email);
            return new AuthResult(AuthResult::MFA_REQUIRED, $user);
        }

        $_SESSION['auth'] = ['uid' => (int) $user['id'], 'role' => $user['role'], 'at' => time(), 'workspace' => $workspace];
        acad_db()->prepare('UPDATE users SET last_login_at = NOW() WHERE id = :id')->execute([':id' => $user['id']]);
        $this->audit('login_success', (int) $user['id'], $email);
        return new AuthResult(AuthResult::OK, $user);
    }

    public static function user(): ?array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return null;
        }
        return $_SESSION['auth'] ?? null;
    }

    public function logout(): void
    {
        acad_session_start();
        $this->audit('logout', $_SESSION['auth']['uid'] ?? null, null);
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $p['path'], 'secure' => $p['secure'], 'httponly' => true, 'samesite' => 'Lax']);
        }
        session_destroy();
    }

    private function audit(string $event, ?int $userId, ?string $email): void
    {
        $db = acad_db();
        if (!$db) {
            return;
        }
        try {
            $stmt = $db->prepare('INSERT INTO auth_audit (event, user_id, email_hash, ip_hash, user_agent, created_at) VALUES (:e, :u, :m, :ip, :ua, NOW())');
            $stmt->execute([
                ':e'  => $event,
                ':u'  => $userId,
                ':m'  => $email !== null ? hash('sha256', $email) : null,
                ':ip' => acad_client_fingerprint(),
                ':ua' => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
            ]);
        } catch (PDOException $ex) {
            error_log('Acadlytic auth audit failed: ' . $ex->getMessage());
        }
    }
}
