# Mie Ayam Gapuro

## Deskripsi Proyek

Mie Ayam Gapuro adalah sebuah aplikasi berbasis web yang dirancang untuk membantu mengelola bisnis kuliner, khususnya penjualan mie ayam. Aplikasi ini menyediakan fitur untuk mengelola menu, melakukan pemesanan, dan mengatur paket hemat. Sistem ini juga mendukung otentikasi pengguna untuk keamanan dan manajemen data yang lebih baik.

## Fitur Utama

- **Manajemen Menu:** Tambah, ubah, dan hapus menu mie ayam.
- **Manajemen Pemesanan:** Mengelola daftar pemesanan dari pelanggan.
- **Paket Hemat:** Fitur untuk menawarkan paket hemat kepada pelanggan.
- **Otentikasi Pengguna:** Sistem login menggunakan Laravel Sanctum.
- **Dashboard Pengguna:** Antarmuka untuk mengelola data dengan mudah.

## Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Frontend:** Bootstrap 5
- **Database:** MySQL
- **API Testing:** Postman

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1. **Clone Repository:**

   ```bash
   git clone https://github.com/username/mie-ayam-gapuro.git
   ```

2. **Masuk ke Direktori Proyek:**

   ```bash
   cd mie-ayam-gapuro
   ```

3. **Install Dependensi:**

   ```bash
   composer install
   npm install
   ```

4. **Copy File Konfigurasi:**

   ```bash
   cp .env.example .env
   ```

5. **Atur File ****`.env`****:**

   - Konfigurasi database Anda di file `.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=project_mieayam
     DB_USERNAME=root
     DB_PASSWORD=
     ```

6. **Generate Key Aplikasi:**

   ```bash
   php artisan key:generate
   ```

7. **Migrasi Database:**

   ```bash
   php artisan migrate
   ```

8. **Jalankan Server:**

   ```bash
   php artisan serve
   ```

   Aplikasi akan tersedia di [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Dokumentasi API

Gunakan Postman atau aplikasi serupa untuk menguji API. Beberapa endpoint utama:

- **Login:**

  - URL: `/api/login`
  - Metode: `POST`
  - Body:
    ```json
    {
      "email": "user@example.com",
      "password": "password"
    }
    ```

- **Manajemen Menu:**

  - URL: `/api/menu`
  - Metode: `GET`, `POST`, `PUT`, `DELETE`

- **Manajemen Pemesanan:**

  - URL: `/api/pemesanan`
  - Metode: `GET`, `POST`, `PUT`, `DELETE`



Dibuat dengan ❤ oleh tim developer Website Mie Ayam Gapuro
