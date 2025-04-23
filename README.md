<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
# 👶 Daycare App by Digital Forte Indonesia

Sebuah aplikasi manajemen penitipan anak berbasis web yang membantu pengguna dan pengelola daycare dalam memantau informasi dan kesehatan anak secara real-time.

![Daycare App Screenshot](https://via.placeholder.com/1200x600.png?text=Daycare+App+Screenshot)

---

## ✨ Fitur Utama

- 🔐 **Login Multi-Role**  
  - Pengguna Biasa (orang tua)
  - Admin (pengelola & pendamping anak)

- 🧒 **Manajemen Anak**  
  Kelola data anak, profil, dan status aktif.

- 💊 **Pantau Kesehatan**  
  Catat suhu, status kesehatan, dan riwayat harian anak.

- 📢 **Informasi Real-Time**  
  Update kondisi anak secara langsung dari pengasuh ke orang tua.

---

## 🚀 Teknologi yang Digunakan

- **Framework**: Laravel
- **Frontend**: Tailwind CSS
- **Bahasa Pemrograman**: PHP

---

## ⚙️ Cara Menjalankan Proyek

Pastikan sudah menginstal PHP, Composer, dan MySQL/MariaDB.

```bash
# Clone repo
git clone https://github.com/username/daycare-app.git
cd daycare-app

# Install dependencies
composer install

# Copy .env dan konfigurasi
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Jalankan server
php artisan serve
