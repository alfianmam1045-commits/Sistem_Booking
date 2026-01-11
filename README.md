# 📌 SISTEM BOOKING

## 📖 Deskripsi Singkat

SISTEM BOOKING adalah sebuah aplikasi **Web Service berbasis REST API** yang digunakan untuk mengelola proses **autentikasi pengguna, manajemen layanan, pemesanan (booking), pembayaran, serta pencatatan log aktivitas**.  
Sistem ini dikembangkan sebagai **project mahasiswa** dan dirancang dengan arsitektur yang sederhana namun terstruktur.

---

## 🚀 Fitur Utama

-   Autentikasi pengguna (Register, Login, Logout) menggunakan JWT
-   Manajemen data pengguna
-   Manajemen layanan
-   Manajemen pemesanan (booking)
-   Manajemen pembayaran
-   Pencatatan log aktivitas sistem

---

## ⚙️ Cara Menjalankan Sistem

### Clone Repository

```bash
git clone https://github.com/username/nama-repository.git
cd nama-repository
```

### Install Dependency

```bash
composer install
```

### Konfigurasi Environtment

```bash
cp .env.example .env
php artisan key:generate
```

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database

```bash
php artisan migrate:fresh --seed
```

### Menjalankan Server

```bash
php artisan serve
```

## Informasi Akun Uji Coba

```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

## Dokumentasi API

Link Akses : https://documenter.getpostman.com/view/51414863/2sBXVfiWwZ
