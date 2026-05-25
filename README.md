# Sistem Manajemen Dapur Takjil Ramadhan

## Overview Project

Pada pengembangan **Week 10** ini, proyek Dapur Takjil ditingkatkan dengan fokus pada **keamanan aplikasi**, **autentikasi modern**, dan **pengujian otomatis**. Pembaruan utama mencakup implementasi **Google reCAPTCHA v2** sebagai proteksi anti-bot pada form publik, integrasi **Login Google (SSO)** menggunakan **Laravel Socialite** untuk kemudahan akses pengguna, serta penerapan **Feature Testing** dengan **PHPUnit** guna memastikan kualitas dan keandalan setiap rute aplikasi.

---

## Fitur Utama Sistem

Selain fitur yang sudah ada dari minggu-minggu sebelumnya, aplikasi kini dilengkapi dengan fitur-fitur baru sebagai berikut:

1. **Keamanan Anti-Bot (Google reCAPTCHA v2):** Implementasi widget Google reCAPTCHA v2 pada halaman **Login** dan **Register** untuk mencegah serangan _bot_ dan _spam_. Sistem secara otomatis menolak form (_redirect back with errors_) jika pengguna tidak mencentang reCAPTCHA.
2. **Single Sign-On (SSO) Google dengan Laravel Socialite:** Menyediakan alternatif login menggunakan akun Google. Jika pengguna berhasil login melalui Google, sistem mencatat datanya ke database atau langsung mengizinkan masuk jika email sudah terdaftar.
3. **Quality Assurance / Pengujian Otomatis (PHPUnit):** Pembuatan file _Feature Test_ (`ProjectFeatureTest.php`) yang berisi minimal 2 skenario pengujian rute HTTP untuk memastikan aplikasi berjalan normal, mencakup pengujian status HTTP 200 dan 302.

---

## Struktur Direktori Proyek (Week 10 Architecture)

Struktur proyek kini mencakup komponen keamanan, autentikasi modern, dan pengujian:

    dapur-takjil-laravel/
    │
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── Auth/
    │   │   │   ├── AuthenticatedSessionController.php  # Login standar dengan reCAPTCHA
    │   │   │   ├── GoogleController.php                # [NEW] Handler SSO Google
    │   │   │   └── RegisteredUserController.php        # Registrasi dengan reCAPTCHA
    │   │   ├── ProductController.php                   # CRUD Produk
    │   │   └── ProfileController.php                   # Manajemen Profil
    │   ├── Http/Requests/Auth/
    │   │   └── LoginRequest.php                        # [MODIFIED] Validasi + reCAPTCHA
    │   ├── Http/Middleware/
    │   │   └── CheckRole.php                           # Middleware Role Admin/User
    │   ├── Rules/
    │   │   └── ReCaptcha.php                           # [NEW] Custom Validation Rule reCAPTCHA
    │   └── Models/
    │       └── User.php                                # Model User
    │
    ├── config/
    │   └── services.php                                # [MODIFIED] Konfigurasi Google & reCAPTCHA
    │
    ├── database/
    │   ├── factories/
    │   │   └── UserFactory.php                         # [NEW] Factory untuk testing
    │   └── migrations/
    │
    ├── resources/views/
    │   ├── auth/
    │   │   ├── login.blade.php                         # [MODIFIED] + reCAPTCHA + Tombol Google
    │   │   └── register.blade.php                      # [MODIFIED] + reCAPTCHA
    │   └── layouts/
    │
    ├── routes/
    │   ├── web.php
    │   └── auth.php                                    # [MODIFIED] + Route Google SSO
    │
    ├── tests/Feature/
    │   ├── ProjectFeatureTest.php                      # [NEW] Pengujian HTTP 200 & 302
    │   └── ExampleTest.php                             # [MODIFIED] + RefreshDatabase
    │
    └── .env                                            # [MODIFIED] + Variabel reCAPTCHA & Google

---

## Penjelasan Teknis Pengembangan (Week 10)

### 1. Keamanan Anti-Bot (Google reCAPTCHA v2)

Diimplementasikan widget Google reCAPTCHA v2 pada halaman **Login** dan **Register**. Pada sisi _front-end_, widget reCAPTCHA ditampilkan menggunakan script resmi Google (`https://www.google.com/recaptcha/api.js`) dan elemen `<div class="g-recaptcha">`. Pada sisi _back-end_, dibuat **Custom Validation Rule** (`App\Rules\ReCaptcha`) yang memverifikasi token reCAPTCHA melalui API Google (`siteverify`). Jika pengguna tidak mencentang reCAPTCHA, form akan ditolak dan menampilkan pesan error.

**File terkait:**
- `app/Rules/ReCaptcha.php` — Custom Rule untuk validasi token reCAPTCHA
- `app/Http/Requests/Auth/LoginRequest.php` — Integrasi validasi reCAPTCHA pada login
- `app/Http/Controllers/Auth/RegisteredUserController.php` — Integrasi validasi reCAPTCHA pada registrasi
- `resources/views/auth/login.blade.php` — Widget reCAPTCHA pada form login
- `resources/views/auth/register.blade.php` — Widget reCAPTCHA pada form register

### 2. Single Sign-On (SSO) Google dengan Laravel Socialite

Diinstal _package_ `laravel/socialite` untuk mengimplementasikan login menggunakan akun Google. Dibuat controller khusus (`GoogleController`) yang menangani dua proses utama:
- **Redirect ke Google** (`/auth/google`): Mengarahkan pengguna ke halaman autentikasi Google.
- **Callback dari Google** (`/auth/google/callback`): Memproses data pengguna yang dikembalikan oleh Google. Jika email sudah terdaftar di database, pengguna langsung login. Jika belum, sistem membuat akun baru secara otomatis dengan role default `user`.

Tombol "Masuk dengan Google" ditampilkan pada halaman login dengan desain yang responsif dan ikon SVG resmi Google.

**File terkait:**
- `app/Http/Controllers/Auth/GoogleController.php` — Controller SSO Google
- `routes/auth.php` — Route `/auth/google` dan `/auth/google/callback`
- `resources/views/auth/login.blade.php` — Tombol "Masuk dengan Google"
- `config/services.php` — Konfigurasi credential Google OAuth

### 3. Quality Assurance / Pengujian Otomatis (PHPUnit)

Dibuat file _Feature Test_ baru (`ProjectFeatureTest.php`) yang berisi 2 skenario pengujian rute HTTP:

| No | Nama Test | Deskripsi | Status HTTP |
|----|-----------|-----------|-------------|
| 1 | `test_login_page_returns_http_200` | Memastikan halaman login dapat diakses | 200 (OK) |
| 2 | `test_google_redirect_returns_http_302` | Memastikan route Google SSO melakukan redirect | 302 (Redirect) |

Seluruh pengujian dijalankan menggunakan perintah `php artisan test` dan menghasilkan status **PASSED** (27 tests, 63 assertions).

**File terkait:**
- `tests/Feature/ProjectFeatureTest.php` — File pengujian utama
- `database/factories/UserFactory.php` — Factory user untuk mendukung pengujian
- `tests/Feature/ExampleTest.php` — Perbaikan trait `RefreshDatabase`

---

## Cara Menjalankan

### 1. Setup Awal
```bash
composer install
npm install
php artisan migrate --seed
php artisan storage:link
```

### 2. Konfigurasi Environment
Salin `.env.example` ke `.env`, lalu isi variabel berikut:
```env
# Google reCAPTCHA v2
RECAPTCHA_SITE_KEY=<site_key_dari_google>
RECAPTCHA_SECRET_KEY=<secret_key_dari_google>

# Google OAuth (SSO)
GOOGLE_CLIENT_ID=<client_id_dari_google>
GOOGLE_CLIENT_SECRET=<client_secret_dari_google>
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

### 3. Menjalankan Aplikasi
```bash
php artisan serve
npm run dev
```

### 4. Menjalankan Pengujian
```bash
php artisan test
```

---

## Hasil Pengujian

```
Tests:    27 passed (63 assertions)
Duration: 1.89s

✓ ProjectFeatureTest > login page returns http 200
✓ ProjectFeatureTest > google redirect returns http 302
✓ AuthenticationTest > login screen can be rendered
✓ AuthenticationTest > users can authenticate using the login screen
✓ RegistrationTest > registration screen can be rendered
✓ RegistrationTest > new users can register
... dan 21 test lainnya
```
