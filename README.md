# Portfolio

Situs portofolio dengan halaman publik dan panel admin untuk profil, keahlian, pengalaman, proyek, dan sertifikat.

Stack yang terpasang di `composer.json`: Laravel 13, PHP 8.3, SQLite, Vite, dan Tailwind CSS.

## Yang perlu dipasang

- PHP 8.3 atau lebih baru
- Composer 2
- Node.js 20 atau lebih baru, plus npm

## Menjalankan di komputer sendiri

```bash
git clone https://github.com/kuncooroo/portfolio.git
cd portfolio
```

Database bawaan adalah SQLite. Buat file kosongnya dulu.

Windows PowerShell:

```powershell
New-Item -ItemType File -Force -Path database\database.sqlite
```

macOS / Linux:

```bash
touch database/database.sqlite
```

Lalu pasang dependency, buat kunci aplikasi, migrasi, dan isi data contoh:

```bash
composer run setup
php artisan db:seed
composer run dev
```

`composer run setup` menyalin `.env.example` ke `.env`, menjalankan `php artisan key:generate`, migrasi, `npm install`, dan `npm run build`. `composer run dev` menjalankan server PHP dan Vite bersamaan.

Buka [http://127.0.0.1:8000](http://127.0.0.1:8000). `.env.example` sudah memakai `APP_URL=http://localhost:8000`.

## Akun admin contoh

Akun ini dibuat oleh `database/seeders/PortfolioContentSeeder.php`.

| | |
| --- | --- |
| Email | `nayla@portfolio.test` |
| Password | `Senyum#2026` |

Masuk di [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login). Ganti password jika situs ini dipasang di tempat yang bisa diakses orang lain.

## Halaman

- `/` halaman publik
- `/admin` dashboard setelah masuk
