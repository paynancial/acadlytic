-- Acadlytic public site + future auth: MySQL 8 / MariaDB 10.4+ schema.
-- The public site works without a database (enquiries fall back to
-- storage/enquiries/*.jsonl). Import this in cPanel > phpMyAdmin when you
-- configure config/local.php with database credentials.

SET NAMES utf8mb4;

-- Website enquiries: demo, contact, access and password-help requests.
CREATE TABLE IF NOT EXISTS enquiries (
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type        VARCHAR(20)  NOT NULL,
    email       VARCHAR(190) NOT NULL DEFAULT '',
    payload     JSON         NOT NULL,
    page        VARCHAR(255) NOT NULL DEFAULT '',
    ip_hash     CHAR(64)     NOT NULL,
    user_agent  VARCHAR(255) NOT NULL DEFAULT '',
    status      VARCHAR(20)  NOT NULL DEFAULT 'new',
    created_at  DATETIME     NOT NULL,
    INDEX idx_enquiries_type_created (type, created_at),
    INDEX idx_enquiries_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Future workspace authentication (used by includes/auth/AuthService.php
-- once config auth.enabled = true). Not used by the public site today.
-- ---------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS users (
    id             BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email          VARCHAR(190) NOT NULL,
    name           VARCHAR(120) NOT NULL,
    password_hash  VARCHAR(255) NOT NULL,          -- password_hash(PASSWORD_DEFAULT)
    role           VARCHAR(40)  NOT NULL,          -- e.g. super_admin, admin, faculty, student, parent, partner
    institution_id BIGINT UNSIGNED NULL,
    status         ENUM('active','invited','suspended','disabled') NOT NULL DEFAULT 'invited',
    mfa_enabled    TINYINT(1)   NOT NULL DEFAULT 0,
    mfa_secret     VARBINARY(255) NULL,            -- encrypted at application level
    last_login_at  DATETIME     NULL,
    created_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_users_email (email),
    INDEX idx_users_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS password_resets (
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id     BIGINT UNSIGNED NOT NULL,
    token_hash  CHAR(64)     NOT NULL,              -- sha256 of the emailed token; raw token never stored
    expires_at  DATETIME     NOT NULL,
    used_at     DATETIME     NULL,
    created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_resets_token (token_hash),
    INDEX idx_resets_user (user_id),
    CONSTRAINT fk_resets_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS user_sessions (
    id           CHAR(64)     PRIMARY KEY,          -- hash of session id, for device/session management
    user_id      BIGINT UNSIGNED NOT NULL,
    ip_hash      CHAR(64)     NOT NULL,
    user_agent   VARCHAR(255) NOT NULL DEFAULT '',
    created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_seen_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    revoked_at   DATETIME     NULL,
    INDEX idx_sessions_user (user_id),
    CONSTRAINT fk_sessions_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS auth_audit (
    id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event       VARCHAR(40)  NOT NULL,              -- login_success, login_failed, login_locked, logout, ...
    user_id     BIGINT UNSIGNED NULL,
    email_hash  CHAR(64)     NULL,
    ip_hash     CHAR(64)     NOT NULL,
    user_agent  VARCHAR(255) NOT NULL DEFAULT '',
    created_at  DATETIME     NOT NULL,
    INDEX idx_audit_user (user_id, created_at),
    INDEX idx_audit_event (event, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
