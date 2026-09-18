# SPARTAN Environment Configuration

## Lokal (Development)

| Variable | Value | Keterangan |
|----------|-------|------------|
| `APP_NAME` | SPARTAN | Nama aplikasi |
| `APP_ENV` | local | Environment lokal |
| `APP_KEY` | base64:BoOXMM5JTJMtPfngTZnDHULddceBcQvEY1VmPk8ngEI= | App key |
| `APP_DEBUG` | true | Debug mode aktif untuk development |
| `APP_URL` | http://localhost:8000 | URL lokal |
| `SESSION_DOMAIN` | null | Domain session |
| `SESSION_SECURE_COOKIE` | false | Secure cookie nonaktif |
| `LOG_LEVEL` | debug | Log level |
| `DB_CONNECTION` | sqlite | Database connection |
| `DB_DATABASE` | database/database.sqlite | SQLite file |
| `CACHE_DRIVER` | file | Cache driver |
| `QUEUE_CONNECTION` | sync | Queue driver |
| `SESSION_DRIVER` | file | Session driver |
| `FILESYSTEM_DISK` | local | Filesystem disk |
| `MAIL_MAILER` | smtp | Mail driver |
| `MAIL_HOST` | mailhog | Mail host |
| `MAIL_PORT` | 1025 | Mail port |
| `MAIL_USERNAME` | null | Mail username |
| `MAIL_PASSWORD` | null | Mail password |
| `MAIL_ENCRYPTION` | null | Mail encryption |
| `MAIL_FROM_ADDRESS` | hello@example.com | Mail from address |
| `REDIS_HOST` | 127.0.0.1 | Redis host |
| `REDIS_PASSWORD` | null | Redis password |
| `REDIS_PORT` | 6379 | Redis port |

---

## Production (Laravel Cloud)

### APP_URL → Domain Production
```env
APP_URL=https://your-production-domain.com
```
Ganti dengan domain aplikasi production yang aktif di Laravel Cloud.

### SESSION_DOMAIN → Domain Production
```env
SESSION_DOMAIN=your-production-domain.com
```
Harus sesuai dengan `APP_URL` tanpa protokol `https://`.

### DB_DATABASE, DB_USERNAME, DB_PASSWORD → MySQL Credentials
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_production_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
Ambil kredensial MySQL dari Laravel Cloud:
- Masuk ke Laravel Cloud → Project → Databases
- Copy database name, username, dan password

### MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD → SMTP
```env
MAIL_MAILER=smtp
MAIL_HOST=your-mail-host.com
MAIL_PORT=587
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
```
Konfigurasikan sesuai dengan provider email yang digunakan (misal: Gmail, Mailgun, SendGrid, dsb).

### REDIS_HOST, REDIS_PASSWORD, REDIS_PORT → Redis
```env
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```
Di Laravel Cloud, Redis biasanya sudah tersedia. Ganti sesuai dengan kredensial Redis yang diberikan.

### Ringkasan Konfigurasi Production

| Variable | Value | Keterangan |
|----------|-------|------------|
| `APP_NAME` | SPARTAN | Nama aplikasi |
| `APP_ENV` | production | Environment production |
| `APP_DEBUG` | false | Debug mode OFF untuk security |
| `APP_URL` | https://your-production-domain.com | Domain production |
| `SESSION_DOMAIN` | your-production-domain.com | Session domain |
| `SESSION_SECURE_COOKIE` | true | Secure cookie aktif (HTTPS) |
| `LOG_LEVEL` | error | Log level error |
| `DB_CONNECTION` | mysql | Database connection |
| `DB_HOST` | 127.0.0.1 | MySQL host |
| `DB_PORT` | 3306 | MySQL port |
| `DB_DATABASE` | your_production_db | Nama database |
| `DB_USERNAME` | your_db_user | Username MySQL |
| `DB_PASSWORD` | your_db_password | Password MySQL |
| `BROADCAST_DRIVER` | log | Broadcast driver |
| `CACHE_DRIVER` | redis | Cache driver Redis |
| `FILESYSTEM_DISK` | local | Filesystem disk |
| `QUEUE_CONNECTION` | redis | Queue driver Redis |
| `SESSION_DRIVER` | redis | Session driver Redis |
| `SESSION_LIFETIME` | 120 | Session lifetime menit |
| `MAIL_MAILER` | smtp | Mail driver SMTP |
| `MAIL_HOST` | your-mail-host.com | SMTP host |
| `MAIL_PORT` | 587 | SMTP port |
| `MAIL_USERNAME` | your_mail_username | SMTP username |
| `MAIL_PASSWORD` | your_mail_password | SMTP password |
| `MAIL_ENCRYPTION` | tls | SMTP encryption |
| `MAIL_FROM_ADDRESS` | no-reply@your-production-domain.com | Alamat email pengirim |
| `REDIS_HOST` | 127.0.0.1 | Redis host |
| `REDIS_PASSWORD` | null | Redis password |
| `REDIS_PORT` | 6379 | Redis port |

---

## Catatan

1. **`.env`, `.env.local`, `.env.production` diabaikan oleh Git** dan tidak boleh di-commit.
2. **`.env.example`** adalah template yang sudah di-commit dan berisi placeholder.
3. Untuk production, copy isi `.env.production` sebagai referensi, lalu isi dengan kredensial asli dari Laravel Cloud.
4. Jalankan `php artisan key:generate` di server production untuk generate `APP_KEY` baru.
5. Pastikan `php artisan storage:link` sudah dijalankan untuk menyediakan akses file publik.
