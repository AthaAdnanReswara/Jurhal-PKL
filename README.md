// ...existing code...
# Jurnal-PKL (Jurnal Praktik Kerja Lapangan) 📝

Jurnal-PKL adalah aplikasi web untuk mencatat, mengelola, dan merekap kegiatan siswa selama Praktik Kerja Lapangan (PKL). Aplikasi dibangun dengan Laravel (backend) dan Blade + Bootstrap (frontend). Template admin dasar tersedia di folder [material-dashboard-master](material-dashboard-master/).

Ringkasan singkat:
- Multi-peran: Siswa, Pembimbing, Admin.
- CRUD jurnal harian, upload dokumentasi, validasi pembimbing.
- Rekap & export (PDF).
- Dashboard admin untuk data master.

Quick links
- CLI entry: [artisan](artisan)  
- PHP deps: [composer.json](composer.json)  
- JS deps & build: [package.json](package.json)  
- Contoh env: [.env.example](.env.example)  
- Models: [`App\Models\Kegiatan`](app/Models/Kegiatan.php), [`App\Models\Dudi`](app/Models/Dudi.php)  
- Migration contoh kegiatan: [database/migrations/2025_10_17_022804_create_kegiatans_table.php](database/migrations/2025_10_17_022804_create_kegiatans_table.php)  
- View contoh profil siswa: [resources/views/siswa/profile/index.blade.php](resources/views/siswa/profile/index.blade.php)  
- View tambah kegiatan: [resources/views/siswa/kegiatan/tambah.blade.php](resources/views/siswa/kegiatan/tambah.blade.php)  
- Layout utama: [resources/views/layout/app.blade.php](resources/views/layout/app.blade.php)  

Prasyarat
- PHP >= 8.3
- Composer
- Node.js & npm / yarn
- Database (MySQL/Postgres/SQLite)

Instalasi cepat (lokal)
1. Clone:
   git clone https://github.com/username-anda/Jurnal-PKL.git
   cd Jurnal-PKL

2. Install PHP dependencies:
   composer install

3. Salin environment:
   cp .env.example .env
   lalu edit konfigurasi database di `.env` (lihat [`.env.example`](.env.example)).

4. Buat key aplikasi:
   php artisan key:generate

5. (Opsional) Buat symbolic link storage:
   php artisan storage:link

6. Migrasi dan seed:
   php artisan migrate --seed

7. Install dependensi JS dan jalankan Vite:
   npm install
   npm run dev

8. Jalankan server:
   php artisan serve
   buka: http://127.0.0.1:8000

Testing
- Jalankan test suite:
  php artisan test
  atau
  ./vendor/bin/phpunit --configuration phpunit.xml

Catatan implementasi singkat
- Model kegiatan ada di [`App\Models\Kegiatan`](app/Models/Kegiatan.php) — relasi ke siswa.
- Model Dudi ada di [`App\Models\Dudi`](app/Models/Dudi.php) — relasi 1:N ke siswa.
- Struktur view utama menggunakan layout di [resources/views/layout/app.blade.php](resources/views/layout/app.blade.php).
- Contoh halaman profil dan form tambah kegiatan ada di:
  - [resources/views/siswa/profile/index.blade.php](resources/views/siswa/profile/index.blade.php)
  - [resources/views/siswa/kegiatan/tambah.blade.php](resources/views/siswa/kegiatan/tambah.blade.php)

Tips & troubleshooting
- Permission: Pastikan folder `storage/` dan `bootstrap/cache/` bisa ditulis oleh webserver.
- Jika assets tidak muncul, jalankan `npm run dev` dan pastikan Vite berjalan.
- Untuk upload file, periksa konfigurasi disk di [`.env.example`](.env.example) dan `config/filesystems.php`.

Kontribusi
- Fork, buat branch fitur, push, buka Pull Request.
- Ikuti konvensi kode Laravel dan pastikan test lulus sebelum PR.

Lisensi
- MIT (lihat juga [material-dashboard-master/LICENSE.md](material-dashboard-master/LICENSE.md) untuk aset template pihak ketiga).

Jika butuh README versi bahasa Inggris atau template README singkat untuk GitHub repo, beri tahu.
// ...existing code...