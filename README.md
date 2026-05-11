<p align="center">
  <img src="public/assets/images/Logo.jpeg" width="120" alt="TEFA MUTU Logo">
</p>

<h2 align="center">TEFA MUTU — Website Sekolah & Layanan Industri</h2>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Bootstrap-4.x-7952B3?logo=bootstrap" alt="Bootstrap">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## Tentang Proyek

**TEFA MUTU** (Teaching Factory) adalah platform website resmi sekolah yang menyediakan informasi seputar kegiatan sekolah, produk hasil karya siswa, serta layanan pemesanan jasa dan produk dari unit produksi sekolah.

Fitur utama yang tersedia:

- Halaman beranda dengan slider, berita terbaru, dan produk unggulan
- Manajemen berita dan agenda sekolah
- Katalog produk hasil karya siswa
- **Form order layanan** — masyarakat dapat memesan produk atau jasa langsung dari website
- Profil rekanan industri mitra sekolah
- Struktur organisasi, visi, dan misi sekolah
- Galeri foto dan video kegiatan

---

## Teknologi yang Digunakan

- **[Laravel 13](https://laravel.com)** — Framework PHP backend
- **[Bootstrap 5](https://getbootstrap.com/docs/4.6)** — UI framework responsif
- **[Font Awesome 5](https://fontawesome.com)** — Ikon
- **MySQL** — Database
- **Blade Components** — Navbar dan footer sebagai komponen reusable

---

## Instalasi

### Prasyarat

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/username/tefa-mutu.git
cd tefa-mutu

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Sesuaikan konfigurasi database di file .env
DB_DATABASE=tefa_mutu
DB_USERNAME=root
DB_PASSWORD=

# 6. Jalankan migrasi
php artisan migrate

# 7. (Opsional) Jalankan seeder
php artisan db:seed

# 8. Jalankan server lokal
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

---

## Struktur Direktori Penting

resources/
├── views/
│ ├── layouts/
│ │ └── app.blade.php # Layout utama
│ ├── components/
│ │ ├── navbar.blade.php # Komponen navbar
│ │ └── footer.blade.php # Komponen footer
│ ├── welcome.blade.php # Halaman beranda
│ ├── berita.blade.php # Halaman daftar berita
│ └── order.blade.php # Halaman form order
public/
└── assets/
├── images/ # Gambar konten & slider
├── front/
│ ├── css/ # Bootstrap & custom CSS
│ └── js/ # Bootstrap bundle JS
└── fontawesome/ # Ikon Font Awesome

---

## Kontribusi

Kontribusi sangat terbuka! Silakan fork repositori ini, buat branch fitur baru, lalu ajukan pull request. Pastikan kode mengikuti standar PSR-12 dan sudah diuji sebelum diajukan.

---

## Keamanan

Jika menemukan celah keamanan pada aplikasi ini, harap laporkan melalui email ke pengelola proyek. Setiap laporan akan segera ditindaklanjuti.

---

## Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT) — bebas digunakan dan dimodifikasi dengan tetap mencantumkan atribusi.
