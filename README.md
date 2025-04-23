
# 👶 Daycare App by Digital Forte Indonesia

Sebuah aplikasi manajemen penitipan anak berbasis web yang membantu pengguna dan pengelola daycare dalam memantau informasi dan kesehatan anak secara real-time.

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
git clone https://github.com/username/daycare-app.git](https://github.com/IHsanwar/be-daycare-dfi/
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
