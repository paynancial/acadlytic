# 10 · Infrastructure, scalability, observability and disaster recovery

## 5. Technical architecture: evaluated choices

| Layer | Options considered | Recommendation | Why |
|---|---|---|---|
| Frontend (SaaS) | Next.js; React + Vite SPA; Laravel + Inertia | **React + TypeScript SPA (Vite)** served from `app.acadlytic.com` | The app is authenticated, so SSR/SEO adds little. An SPA consuming `/api/v1` keeps the API-first contract. Next.js stays an option for a future customer portal needing SSR. |
| Frontend (marketing) | Rewrite in Next.js; keep PHP | **Keep the current PHP site** | Live, fast (mobile LCP ≈ 1.7s in lab), SEO-complete; a rewrite adds risk without user benefit |
| Backend | Laravel (PHP), NestJS (Node), Django, Spring | **Laravel 11+ on PHP 8.3+**, modular monolith | Team and codebase are PHP; mature queues (Horizon), policies, Sanctum, migrations, testing; fast delivery |
| Database | PostgreSQL, MySQL | **PostgreSQL 16+** (managed) | RLS for tenant isolation, JSONB, partitioning, full-text search, `pgvector` |
| Cache / sessions / queues | Redis, Memcached, managed queues | **Redis** (managed) + Laravel Horizon; managed queue (e.g. SQS-class) at growth if needed | One component for MVP; clear upgrade path |
| Object storage | S3-compatible | **S3-compatible**, private, versioning + lifecycle, object lock for audit archive | Standard, cheap, signed URLs |
| Search | PostgreSQL FTS, OpenSearch, Meilisearch | **PostgreSQL FTS + `pg_trgm`** initially; dedicated search at scale (Phase F) | Avoids a second data store and a second tenant-isolation surface early |
| AI | Direct SDK calls; gateway | **AI gateway module** + provider adapters | Central safety, audit, quotas, routing ([07](07-ai-architecture.md)) |
| Auth | Custom; managed IdP (Auth0/Cognito/Entra) | **In-app identity** (Argon2id, TOTP, sessions) with SAML/OIDC federation for SSO | Fewer sub-processors early; federation when institutions require SSO |
| Notifications | Direct providers | Channel adapters: email, SMS, WhatsApp, push | Swap providers without domain changes |
| Observability | — | Structured logs + error tracking + metrics + tracing (OpenTelemetry) + uptime | See below |
| CI/CD | GitHub Actions | **GitHub Actions** (already used by the website) | Tests, static analysis, SCA, secret scan, image build, migrations, deploy with approvals |
| Hosting | VPS; PaaS/containers; Kubernetes | **Managed containers** (e.g. AWS ECS Fargate / Google Cloud Run / Azure Container Apps) in one region; Kubernetes only when justified | Low ops burden, autoscaling, no cluster management |
| IaC | Terraform/OpenTofu | **Terraform/OpenTofu** | Reviewed, reproducible environments |

*Provider names are examples, not decisions or contracts. For Indian institutions an India region is recommended; choose the provider in Phase A sprint 0.*

## 15. Infrastructure by stage

| Stage | Introduce | Trigger to move on |
|---|---|---|
| **MVP** (Phases A–C, first design-partner tenants) | One region; managed Postgres (HA standby, PITR), managed Redis, object storage, 2+ app containers behind a load balancer, 1–2 worker containers (Horizon), CDN/WAF, secrets manager, KMS, CI/CD, error tracking, logs, uptime checks; **staging** mirrors prod at small size; no production data in staging | Sustained DB CPU > ~60%, report queries affecting p95 latency, tenant count or data growth |
| **Growth** (Phases D–E) | **Read replica** for reports; separate queue pools (default, reports, AI, webhooks) with autoscaling; managed queue if Redis queue becomes a bottleneck; CDN caching for static assets; audit archive to object-lock; APM tracing; per-tenant limits and quotas | Enterprise contracts, SSO demand, residency requirements, reporting volume |
| **Enterprise** (Phase F) | Dedicated DB tier per tenant (routing table), optional regional deployments for residency, analytics warehouse + CDC, dedicated search service, WebAuthn, SIEM integration, 24×7 on-call, formal DR tests | Measured scale per module |

## 18. Scalability roadmap: when to introduce what

| Capability | Introduce when | Not before |
|---|---|---|
| Caching (Redis) | Day one (sessions, rate limits, permission cache) | — |
| Queue workers | Day one (emails, scans, exports) | — |
| Object storage | Day one (documents) | — |
| Read replicas | Reporting load measurably affects OLTP (p95 or CPU) | Phase D |
| Search indexing service | FTS relevance/latency insufficient at data volume, or cross-entity search needs | Phase F |
| Analytics warehouse | Cross-year analytics, heavy BI, or tenant BI connectors | Phase F |
| Event streaming (Kafka-class) | Multiple independent consumers with replay needs at high volume | Only with measured need; the outbox + queue covers MVP–growth |
| Service decomposition | A module has distinct scaling, release or compliance needs (see boundaries) | After module boundaries have been stable for months |
| Microservices | Several teams blocked by shared deploys | Not in the current roadmap |

**Future extraction boundaries** (candidates, in order of likely need):
1. **AI gateway**: different scaling, cost profile and provider dependencies.
2. **Communications delivery**: bursty, provider-bound, and has its own retry semantics.
3. **Reporting/analytics**: heavy reads; moves to the warehouse.
4. **Documents processing**: scanning, OCR, CPU-heavy.
5. **Integrations**: third-party failure isolation.

The core CRM, student and academic modules stay together. They share transactions.

## Observability

| Signal | Design |
|---|---|
| Application logs | Structured JSON with `trace_id`, `tenant_id`, `user_id` (IDs only); PII redaction processor; centralised, retained per policy |
| Audit logs | Separate store ([08](08-security-privacy.md#audit-logging)); not mixed with debug logs |
| Infrastructure metrics | CPU/memory/connections for containers, DB, Redis; storage usage |
| APM / tracing | OpenTelemetry traces across API → DB → queue → provider; p50/p95/p99 per endpoint |
| Error monitoring | Error tracker (self-hosted or SaaS; if SaaS, listed as a sub-processor with PII scrubbing) |
| Database monitoring | Slow queries, locks, replication lag, bloat, connection saturation |
| Queue monitoring | Depth, age of oldest job, failure rates, dead-letter counts per queue |
| AI usage monitoring | Requests, tokens, cost, latency, refusal/safety flags per tenant and feature |
| API monitoring | Rate-limit hits, 4xx/5xx by endpoint and tenant, webhook delivery success |
| Uptime | External synthetic checks for `acadlytic.com`, `app.acadlytic.com/health`, login flow |

**Production alerts** (thresholds tuned after baseline):

| Alert | Example condition |
|---|---|
| Authentication failures | Spike in `auth.login_failed` per tenant or IP; lockouts above baseline; MFA failures |
| Error spikes | 5xx rate > baseline × N for 5 min |
| Queue failures | Oldest job age > SLA; DLQ growth; worker crash loop |
| Database saturation | Connections > 80%; CPU > 80% sustained; replication lag > threshold; storage > 80% |
| API latency | p95 > target for key endpoints for 10 min |
| Storage failures | Upload/scan pipeline errors; object store 5xx |
| Suspicious activity | Mass export/download by one user; access denials burst; support-access grant used; new admin role assigned outside hours; cross-tenant access attempt blocked by RLS (should be zero) |

## 20. Disaster recovery

Targets below are **starting assumptions for planning**, not commitments. They become customer commitments only after restore tests prove them, and are set in contracts.

| Item | Proposal | Assumptions |
|---|---|---|
| Backup policy | Managed Postgres automated daily snapshots + continuous WAL archiving (PITR); object storage versioning + lifecycle; configuration in IaC (git); secrets backed by provider | Managed database service with PITR |
| Frequency | Continuous (WAL) + daily full snapshots; object storage continuous (versioned) | — |
| Retention of backups | e.g. 35 days PITR window, monthly snapshots kept longer per policy | Retention policy to be approved; longer retention increases erasure complexity |
| Encryption | KMS-encrypted backups; copies in a separate account/project and, at growth stage, a second region | — |
| Restore testing | Quarterly full restore into an isolated environment + integrity checks; tenant-level logical restore rehearsed | Test results recorded as evidence |
| **RPO (MVP target)** | ≤ 15 minutes for the database; ≤ 24 h for derived data (search indexes, caches, reports; rebuildable) | PITR granularity of the chosen provider (typically ≤ 5 min) plus margin |
| **RTO (MVP target)** | ≤ 4 hours for a full regional restore of the database and app; ≤ 1 hour for app-only failures (stateless redeploy) | Single region; IaC redeploy; runbooks rehearsed |
| Failover | MVP: multi-AZ HA database standby (automatic zone failover); app containers across zones. Enterprise: warm standby in a second region if contracted | Region-level outage beyond MVP scope; stated honestly to customers |
| Incident procedures | Severity levels, on-call rota, communication templates, status page updates, customer notification per contract | Status page is a PLANNED public page |
| Business continuity | Documented dependencies (cloud, email, AI providers), provider fallbacks where possible (secondary email provider, AI model fallback), read-only degraded mode for maintenance | — |
