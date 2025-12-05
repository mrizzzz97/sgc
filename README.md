# SGC - Sistem Gamifikasi Pembelajaran

Aplikasi web pembelajaran berbasis gamifikasi yang dibangun dengan Laravel untuk meningkatkan engagement siswa melalui sistem poin dan sertifikat.

## Fitur Utama

- 📚 **Manajemen Modul & Bab Pembelajaran** - Kelola materi pembelajaran dengan struktur bab yang terorganisir
- 👤 **Sistem Peran Pengguna** - Admin, Guru, dan Siswa dengan hak akses berbeda
- 🎮 **Gamifikasi** - Sistem poin harian (Daily XP) untuk memotivasi siswa
- 📊 **Tracking Progres** - Monitor perkembangan siswa per bab dan modul
- 🏆 **Sertifikat** - Sistem penerbitan sertifikat otomatis setelah menyelesaikan modul
- 💬 **Sistem Komentar** - Fitur diskusi dan feedback untuk setiap modul dan bab
- 📱 **Responsive Design** - Kompatibel dengan desktop dan perangkat mobile

## Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- Database MySQL/MariaDB
- Laravel 11.x

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd sgc
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgc
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Assets
```bash
npm run build
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akun Testing

Aplikasi sudah dilengkapi dengan akun-akun testing yang siap digunakan:

### 📌 Akun Admin
- **Email:** admin@sgc.com
- **Password:** admin@sgc.com
- **Akses:** Full access untuk mengelola sistem, pengguna, modul, dan laporan

### 👨‍🏫 Akun Guru
- **Email:** guru@sgc.com
- **Password:** guru@sgc.com
- **Akses:** Mengelola modul, bab pembelajaran, melihat progres siswa, dan memberikan feedback

### 👨‍🎓 Akun Siswa
- **Email:** siswa@sgc.com
- **Password:** siswa@sgc.com
- **Akses:** Mengakses modul, menyelesaikan bab pembelajaran, mengumpulkan poin, dan melihat sertifikat

## Cara Penggunaan

### Untuk Admin
1. Login menggunakan akun admin
2. Kelola data pengguna (Admin, Guru, Siswa)
3. Pantau semua aktivitas dan laporan sistem
4. Kelola pengaturan aplikasi

### Untuk Guru
1. Login menggunakan akun guru
2. Buat dan edit modul pembelajaran
3. Tambahkan bab dan pertanyaan
4. Lihat progres dan performa siswa
5. Berikan feedback melalui sistem komentar

### Untuk Siswa
1. Login menggunakan akun siswa
2. Pilih dan ikuti modul yang tersedia
3. Selesaikan setiap bab pembelajaran
4. Kumpulkan poin harian (Daily XP)
5. Dapatkan sertifikat setelah menyelesaikan modul
6. Lihat ranking dan progress di dashboard

## Struktur Project

```
app/
├── Helpers/          # Helper functions
├── Http/
│   ├── Controllers/  # Controller aplikasi
│   ├── Middleware/   # Middleware custom
│   └── Requests/     # Form requests
├── Models/           # Eloquent models
└── Providers/        # Service providers

database/
├── migrations/       # Database migrations
├── factories/        # Model factories
└── seeders/          # Database seeders

resources/
├── css/              # Stylesheet
├── js/               # JavaScript
└── views/            # Blade templates

routes/
└── web.php           # Web routes

config/               # Configuration files
storage/              # File storage
tests/                # Test files
```

## Database Models

- **User** - Pengguna sistem (Admin, Guru, Siswa)
- **Module** - Modul pembelajaran
- **Chapter** - Bab dalam modul
- **ChapterPage** - Halaman konten bab
- **Question** - Pertanyaan pembelajaran
- **Answer** - Jawaban siswa
- **Certificate** - Sertifikat penyelesaian
- **Enrollment** - Pendaftaran siswa di modul
- **Comment** - Komentar dan diskusi
- **DailyXp** - Poin harian siswa

## Command Penting

```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Run tests
php artisan test

# Compile assets (development)
npm run dev

# Compile assets (production)
npm run build
```

## Troubleshooting

### Aplikasi tidak bisa diakses
- Pastikan server Laravel berjalan dengan `php artisan serve`
- Cek konfigurasi `.env` sudah benar
- Cek port 8000 tidak digunakan oleh aplikasi lain

### Database error
- Pastikan database sudah dibuat dan konfigurasi `.env` benar
- Jalankan `php artisan migrate` untuk membuat tabel
- Jalankan `php artisan db:seed` untuk mengisi data testing

### Login gagal
- Pastikan Anda menggunakan email dan password yang benar
- Jalankan `php artisan db:seed` untuk reset akun testing
- Cek database apakah tabel users sudah ada

## Dukungan dan Kontribusi

Untuk melaporkan bug atau mengusulkan fitur, silakan buat issue di repository ini.

## Lisensi

Proyek ini dilisensikan di bawah MIT License.

---

**Terakhir diupdate:** Desember 2025
