# Mie Ayam Gapuro

## Deskripsi Proyek

**Mie Ayam Gapuro** adalah aplikasi web berbasis **Laravel 11** yang digunakan untuk mengelola bisnis kuliner mie ayam.  
Aplikasi ini mendukung manajemen menu, pemesanan, paket hemat, serta dilengkapi dengan mekanisme keamanan data berbasis Blockchain Ledger (Integrity Log) untuk mendeteksi perubahan data ilegal (tampering).
---

## Fitur Utama

### 🔹 Manajemen Data
- Manajemen Menu
- Manajemen Pemesanan
- Manajemen Paket Hemat
- Manajemen Kategori

### 🔹 Sistem Pengguna
- Otentikasi Login & Role (Admin & User)
- Dashboard Admin & User

### 🔹 Keamanan & Integrity System
- **Blockchain-like Integrity Log**
- Otomatis mencatat perubahan data menggunakan **Observer**
- Hash SHA-256 + Previous Hash
- Fitur **System Integrity Checker** untuk mendeteksi manipulasi data database
---

## 🛡️ Mekanisme Blockchain Integrity (Fitur Khusus)

Sistem ini menggunakan konsep **Blockchain Ledger sederhana** dengan:
- **IntegrityLog Table**
- **Hashing SHA-256**
- **Previous Hash (Chain Validation)**
- **Observer pada Model Pemesanan**

### Alur Kerja:
1. Data dibuat / diubah (create, update, delete)
2. Observer aktif otomatis
3. Data dicatat ke tabel `integrity_logs`
4. Sistem membuat hash + previous hash
5. Admin dapat mengecek status valid / tampered
---

## Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Frontend:** Bootstrap 5
- **Database:** MySQL
- **Security Concept:** Observer + Hashing (Blockchain-like)
- **API Testing:** Postman
---

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1. **Clone Repository:**

   ```bash
   git clone https://github.com/username/mie-ayam-gapuro.git](https://github.com/Imnotrar/laravel-web-project-mie-ayam.git
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
