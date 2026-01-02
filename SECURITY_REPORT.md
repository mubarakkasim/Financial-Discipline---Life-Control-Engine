# Security & Data Protection Report

## 1. Authentication Flow
- **Registration**: Email and strong password verification.
- **Login**: Rate-limited brute-force protection (via Laravel Breeze).
- **Session Management**: Secure, encrypted cookies with auto-expiration.
- **Listeners**: `LogSuccessfulLogin` and `LogFailedLogin` events are captured in `SecurityLog`.

## 2. Database Schema for Security
### Users Table
- `role`: (string) 'user' or 'admin'.
- `email_verified_at`: Required for sensitive operations.

### Security Logs Table
- `user_id`: Links event to identity.
- `event_type`: Categorization (e.g., `login_success`, `login_failed`, `unauthorized_access_attempt`).
- `action`: Human-readable description.
- `metadata`: JSON blob containing context (model changes, browser info).

## 3. Data Protection (At Rest & In Transit)
- **Encryption at Rest**: Sensitive financial fields (`amount`, `target_amount`, `current_savings`) use Laravel's `encrypted` cast, stored in the database as AES-256-CBC encrypted strings.
- **In-Memory Calculation**: Financial Engine refactored to decrypt records into memory before performing aggregations to maintain database-level opacity.
- **CSRF Protection**: Applied globally to all POST/PUT/DELETE routes via middleware.
- **XSS Prevention**: Automatic Blade escaping and strictly validated input types.

## 4. Authorization (RBAC)
- **Middleware**: `EnsureRole` middleware implemented to enforce route-level access control.
- **Principle of Least Privilege**: Users can only see their own records (filtered by `user_id` in controllers).

## 5. Deployment Checklist
- [ ] Set `APP_DEBUG=false` in production.
- [ ] Enforce `HTTPS` using `URL::forceScheme('https')`.
- [ ] Rotate `APP_KEY` periodically (noting this will invalidate existing encrypted data).
- [ ] Configure `backup:run` (Spatie Backup) for encrypted off-site backups.
- [ ] Set `SESSION_SECURE_COOKIE=true` for HTTPS-only sessions.
- [ ] Enable Rate Limiting (`Route::middleware('throttle:60,1')`).

## 6. Threat Model Overview
| Threat | Mitigation |
| --- | --- |
| Brute Force Login | Rate limiting + Security logging of failures |
| Session Hijacking | HTTPS + Session ID rotation on login |
| Data Breach (DB) | Primary financial data is AES-256 encrypted |
| Mass Assignment | Model `$fillable` protection enforced |
| SQL Injection | Eloquent PDO binding everywhere |
