# Sistem Manajemen Dapur Takjil Ramadhan

## Overview Project

Sistem Manajemen Dapur Takjil ini adalah aplikasi berbasis web yang dikembangkan untuk memenuhi Tugas Praktikum ISB-310 (Sistem Informasi Web). Proyek ini mensimulasikan pencatatan stok dan penyaluran menu takjil selama bulan Ramadhan.

Pada pengembangan **Week 3** ini, sistem yang sebelumnya berfokus pada interaktivitas antarmuka (_Client-Side_ dengan JavaScript) telah ditingkatkan ke tingkat _Server-Side_ menggunakan **PHP**. [cite_start]Fokus utama pada pembaruan ini adalah implementasi sistem autentikasi pengguna (Login/Logout) menggunakan manajemen status dari **Session** dan **Cookies**[cite: 3, 5].

---

## Fitur Sistem

Berikut adalah daftar fitur yang berjalan pada sistem saat ini, dengan sorotan pada penambahan fitur terbaru di Week 3:

1. [cite_start]**[NEW] Sistem Autentikasi Login (PHP Session):** Mencegah akses masuk ke halaman beranda dan kelola data jika pengguna belum melakukan proses login[cite: 9, 13, 15].
2. [cite_start]**[NEW] Fitur Remember Me (PHP Cookies):** Menyimpan _username_ pengguna di _browser_ sehingga saat kembali ke halaman login, kolom _username_ akan terisi otomatis[cite: 20, 22, 23].
3. [cite_start]**[NEW] Fitur Logout Aman:** Menghapus seluruh sesi pengguna dan mengembalikan ke halaman login untuk menjaga keamanan akses[cite: 16, 18, 19].
4. [cite_start]**[NEW] Penanganan Error Modern:** Pesan peringatan jika kredensial login salah kini menggunakan komponen _Alert_ bawaan Bootstrap, menggantikan _alert_ bawaan JavaScript (_syarat bonus fungsional_)[cite: 25, 26].
5. **[NEW] Sapaan Pengguna Dinamis:** Navbar akan menampilkan nama pengguna yang sedang aktif (contoh: "Hai, admin!").
6. **Dark Mode (JS LocalStorage):** Fitur pergantian tema yang statusnya tersimpan secara permanen di _browser_.
7. **Manajemen Stok Real-time (JS LocalStorage):** Fitur penyaluran porsi takjil yang otomatis mengurangi angka stok tanpa perlu me-_refresh_ halaman.
8. **Keranjang / Rencana Penyaluran (JS SessionStorage):** Fitur menyimpan menu ke dalam daftar rencana sementara menggunakan _Pop-up_ Modal.

---

## Struktur Direktori Proyek

Karena transisi ke bahasa pemrograman PHP, seluruh file `.html` utama telah diubah menjadi `.php`.

    manajemen-takjil/
    │
    ├── login.php              # [NEW] Halaman autentikasi & form login
    ├── logout.php             # [NEW] File aksi untuk menghancurkan session
    ├── index.php              # Halaman utama (Katalog Menu) + Proteksi Session
    ├── kelola.php             # Halaman form input data + Proteksi Session
    │
    ├── css/
    │   └── style.css          # Styling kustom & logika visual Dark Mode
    ├── js/
    │   └── script.js          # Logika fungsionalitas Vanilla JS (Web Storage)
    ├── assets/
    │   ├── favicon.jpeg       # Ikon kecil pada tab browser
    │   └── pola-ramadhan.webp # Latar belakang Hero Section
    └── README.md              # Dokumentasi lengkap proyek

---

## Penjelasan Teknis tentang Week 3 Ini

Pada _Week 3_, sistem dibangun ulang agar dapat memproses logika di sisi server (PHP) untuk memenuhi standar keamanan aplikasi web dasar. Berikut adalah penjabaran teknisnya:

- **Inisialisasi `session_start()`:**
  Fungsi ini dipanggil di baris paling pertama pada file `login.php`, `index.php`, `kelola.php`, dan `logout.php`. Hal ini wajib dilakukan sebelum ada _output_ HTML apa pun yang dikirim ke _browser_ agar mesin PHP mengenali sesi pengguna.

- **Proteksi Halaman (Page Guard):**
  Pada file `index.php` dan `kelola.php`, disematkan pengecekan kondisi `!isset($_SESSION["login"])`. Jika pengguna mencoba "memaksa" masuk melalui URL tanpa melewati form login, fungsi `header("Location: login.php")` akan langsung memblokir akses dan mengalihkan pengguna ke halaman login[cite: 14, 15].

- **Logika _Remember Me_ (`$_COOKIE`):**
  [cite_start]Saat pengguna mencentang _checkbox_ "Remember Me" saat login, sistem memanggil fungsi `setcookie('remember_username', $username, time() + (86400 * 30), "/")` untuk menyimpan _username_ selama 30 hari[cite: 21, 22]. [cite_start]Di halaman `login.php`, sistem akan mengecek apakah _cookie_ ini ada, dan mencetaknya langsung ke dalam atribut `value` pada input form[cite: 23].

- **Penghancuran Sesi (Logout):**
  [cite_start]Aksi _logout_ [cite: 17] [cite_start]ditangani oleh file khusus `logout.php` yang menjalankan `session_unset()` untuk mengosongkan variabel sesi, lalu dilanjutkan dengan `session_destroy()` untuk benar-benar menghapus file sesi dari _server_[cite: 18]. [cite_start]Setelah itu, pengguna diarahkan kembali ke `login.php`[cite: 19].

- **Penerapan Keamanan Tambahan (XSS Prevention):**
  Setiap kali sistem perlu mencetak data yang bersumber dari _input_ pengguna (seperti mengambil `$_SESSION["username"]` untuk sapaan di Navbar atau `$_COOKIE['remember_username']` di form), sistem selalu membungkusnya dengan fungsi `htmlspecialchars()`. Hal ini mencegah celah keamanan _Cross-Site Scripting_ jika ke depannya data diambil dari entitas luar.
