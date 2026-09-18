# SPARTAN

Sistem Informasi Pertanian, Peternakan, Perikanan, dan UMKM.

## Tech Stack

- **Laravel** 11.x
- **PHP** 8.2+
- **MySQL** / SQLite
- **Vite** + Tailwind CSS v4
- **Alpine.js**
- **Redis** (production)
- **Laravel Sanctum**
- **Spatie Packages:** Permission, Medialibrary, Activitylog, Sluggable
- **Maatwebsite Excel** untuk import/export
- **Yajra Datatables** untuk tabel server-side

## Fitur Utama

- Manajemen pengguna & role-based access control
- Data perikanan, peternakan, dan UMKM
- Upload dan manajemen berkas/galeri
- Import dan export data Excel
- Laporan dan dashboard
- Front-end publik dan admin panel
- Activity log

## Persyaratan

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL / SQLite
- Redis (opsional untuk production)

## Instalasi

```bash
# Clone repository
git clone https://github.com/rulikurniawan1983/sptrn.git
cd sptrn

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database (opsional untuk lokal)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Create storage link
php artisan storage:link

# Build assets
npm run build
```

## Menjalankan Aplikasi

### Development
```bash
# Terminal 1: Vite dev server
npm run dev

# Terminal 2: Laravel server
php artisan serve
```

Akses di `http://localhost:8000`

### Production
```bash
# Build assets
npm run build

# Install dependencies tanpa dev
composer install --no-dev --optimize-autoloader

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Environment Variables

Lihat file `env.md` untuk dokumentasi lengkap environment variables.

- `.env` - Environment aktif (development/production)
- `.env.local` - Override lokal
- `.env.production` - Template production
- `.env.example` - Referensi variabel yang dibutuhkan

## Testing

```bash
php artisan test
```

## Deployment

Aplikasi ini otomatis deploy ke Laravel Cloud melalui GitHub Actions.

**Setup GitHub Secrets:**
- `LARAVEL_CLOUD_DEPLOY_HOOK` - URL deploy hook dari Laravel Cloud
- `LARAVEL_CLOUD_SSH_KEY` - Private SSH key untuk akses server
- `LARAVEL_CLOUD_SSH_HOST` - Hostname/IP server
- `LARAVEL_CLOUD_SSH_USER` - Username SSH

**Manual deployment:**
```bash
# Di server Laravel Cloud
cd /home/sites/default
bash deploy-server.sh
```

Lihat `DEPLOY.md` untuk panduan lengkap deployment automation.

## VS Code Tasks

Buka **Terminal → Run Task** (`Ctrl+Shift+B`) untuk mengakses:

- Start Development Server
- Generate APP_KEY
- Run Migrations
- Clear All Caches
- Build Production Assets
- Full Production Deployment

## Scripts

- `deploy.sh` - Deployment script untuk Linux/Mac
- `deploy.bat` - Deployment script untuk Windows
- `deploy-server.sh` - Post-deployment script untuk server

## Struktur Project

```
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Helpers/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── build/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .env
├── .env.example
├── .env.local
├── .env.production
├── composer.json
├── package.json
├── vite.config.js
└── artisan
```

## Kontribusi

1. Fork repository
2. Buat branch baru (`git checkout -b feature/namafitur`)
3. Commit perubahan (`git commit -m 'Add some feature'`)
4. Push ke branch (`git push origin feature/namafitur`)
5. Buka Pull Request

## License

MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## Author

- Ruli Kurniawan - [@rulikurniawan1983](https://github.com/rulikurniawan1983)
