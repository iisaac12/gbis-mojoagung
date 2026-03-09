# GBIS Mojoagung Website

Website resmi GBIS Mojoagung yang dibangun dengan Laravel 9, dirancang untuk memberikan informasi pelayanan, jadwal ibadah, dan dokumentasi kegiatan kepada jemaat dan masyarakat umum secara modern dan profesional.

## ✨ Fitur Utama (Sisi Jemaat/User)

- **Beranda Dinamis:** Slider hero yang dapat diatur, ringkasan jadwal ibadah minggu ini, dan acara mendatang.
- **Tentang Kami:** Profil gereja dan sejarah singkat disertai pratinjau galeri.
- **Jadwal Ibadah:** Daftar lengkap jadwal pelayanan mingguan dengan informasi waktu dan lokasi yang jelas.
- **Acara (Events):** Halaman khusus untuk melihat detail acara gereja, lengkap dengan deskripsi dan rekomendasi acara terkait.
- **Galeri Kegiatan:** Dokumentasi foto kegiatan gereja yang rapi, dikategorikan, dan dilengkapi dengan animasi hover yang elegan.
- **Hubungi Kami:** Form kontak interaktif yang terhubung langsung ke dashboard admin, serta tautan cepat ke WhatsApp dan Email resmi.
- **Desain Responsif:** Tampilan yang optimal di berbagai perangkat (HP, Tablet, Laptop) dengan estetika premium menggunakan *glassmorphism* dan ikon FontAwesome.

## 🛠️ Fitur Admin (Dashboard Pengelolaan)

- **Statistik Dashboard:** Pantauan cepat jumlah layanan, acara, pesan kontak masuk, dan koleksi foto galeri.
- **Manajemen Ibadah (Services):** CRUD (Create, Read, Update, Delete) untuk mengatur jadwal ibadah mingguan.
- **Manajemen Acara (Events):** Pengelolaan acara dengan fitur unggah gambar, pengaturan slug otomatis, dan deskripsi lengkap.
- **Manajemen Galeri:** Unggah dan kategorikan foto kegiatan pelayanan dengan sistem pengelolaan file yang efisien.
- **Sistem Pesan Kontak:** 
    - Membaca pesan masuk dari jemaat.
    - Membalas pesan secara langsung melalui email dari aplikasi.
    - Penghapusan pesan dengan modal konfirmasi kustom.
- **Pengaturan Info Gereja:** Kelola alamat, nomor WhatsApp, dan link sosial media secara terpusat (otomatis memperbarui seluruh footer website).
- **Manajemen Hero Slider:** Unggah dan pilih gambar slider yang tampil di setiap halaman publik secara dinamis.
- **Keamanan:** Sistem login administrator yang aman.

## 🚀 Teknologi yang Digunakan

- **Framework:** Laravel 9
- **Database:** MySQL
- **Frontend:** Blade Templating, Vanilla CSS (Modern CSS), FontAwesome 6 (Font Icons)
- **Email:** Integrasi SMTP Gmail untuk balasan pesan otomatis.
- **Animations:** Intersection Observer API untuk efek *Reveal* saat scroll.

## 📦 Instalasi

1. Clone repositori ini.
2. Jalankan `composer install`.
3. Salin `.env.example` ke `.env` dan konfigurasi database Anda.
4. Jalankan `php artisan key:generate`.
5. Jalankan `php artisan migrate --seed`.
6. Jalankan `php artisan storage:link` untuk menghubungkan folder publik dengan penyimpanan file.
7. Jalankan `php artisan serve`.

---
*Dibuat untuk pelayanan GBIS Mojoagung.*
