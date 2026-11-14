# Portfolio (Laravel, data JSON)

Portfolio pribadi dengan dashboard admin. Konten disimpan di `public/data/data.json`
(tanpa database/migrasi), foto & file di `public/uploads/`, pesan masuk di `storage/app/messages.json`.

## Menjalankan
1. Salin `.env.example` ke `.env` bila belum ada, lalu `php artisan key:generate`.
2. `composer install`
3. `php artisan serve` lalu buka `/` (publik) dan `/admin` (dashboard).

Password admin default ada di `config/portfolio.php`. Ganti lewat `.env`:

    PORTFOLIO_ADMIN_PASSWORD=passwordbaru

## Struktur
| Lokasi | Fungsi |
|---|---|
| `config/portfolio.php` | Password admin, nilai bawaan data, dan definisi field tiap section |
| `app/Support/PortfolioStore.php` | Baca/tulis JSON, upload file, pesan masuk |
| `app/Http/Controllers/PortfolioController.php` | Halaman publik + form Kesan & Pesan |
| `app/Http/Controllers/AdminController.php` | Login, profil, foto, kontak, CV, pesan masuk |
| `app/Http/Controllers/AdminSectionController.php` | CRUD generik semua section |
| `resources/views/portfolio/*` | Satu file per section halaman publik |
| `resources/views/admin/*` | Partial dashboard admin (form dibuat otomatis dari config) |
| `public/styles.css`, `public/app.js` | CSS & JavaScript halaman publik |
| `public/admin.css` | CSS dashboard admin |

## Menambah section / field baru
Tambahkan entri di `sections` pada `config/portfolio.php`. Route, validasi, dan form
admin dibuat otomatis. Tampilannya tinggal dibuat di `resources/views/portfolio/`.
