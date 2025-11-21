# Panduan Sistem Role-Based SGC

## Fitur yang Sudah Diimplementasikan

### 1. Tiga Role Berbeda
- **Siswa (Murid)**: Dapat register mandiri, akses dashboard siswa
- **Guru**: Hanya bisa login, akses dashboard guru, dibuat oleh Admin
- **Admin**: Dapat login, akses dashboard admin, kelola guru

### 2. Autentikasi
- **Register**: Hanya untuk siswa (role otomatis: `murid`)
- **Login**: Untuk semua role (siswa, guru, admin)
- **Redirection**: Otomatis ke dashboard sesuai role

### 3. Dashboard Khusus Role
- `/murid` - Dashboard siswa
- `/guru` - Dashboard guru  
- `/admin` - Dashboard admin dengan menu kelola guru

### 4. Management Guru (Admin Only)
- Daftar guru: `GET /admin/guru`
- Tambah guru: `GET /admin/guru/create` & `POST /admin/guru`
- Edit guru: `GET /admin/guru/{guru}/edit` & `PATCH /admin/guru/{guru}`
- Hapus guru: `DELETE /admin/guru/{guru}`

## Akun Default (Sudah Dibuat)

```
Admin:
- Email: admin@sgc.com
- Password: password
- Role: admin

Guru Test:
- Email: guru@sgc.com
- Password: password
- Role: guru

Siswa Test:
- Email: siswa@sgc.com
- Password: password
- Role: murid
```

## File yang Dibuat/Dimodifikasi

### Controllers
- `app/Http/Controllers/Admin/GuruController.php` - Management guru

### Middleware
- `app/Http/Middleware/RoleMiddleware.php` - Role checking (updated)

### Views
- `resources/views/admin/guru/index.blade.php` - Daftar guru
- `resources/views/admin/guru/create.blade.php` - Form tambah guru
- `resources/views/admin/guru/edit.blade.php` - Form edit guru
- `resources/views/dashboard/admin.blade.php` - Dashboard admin (updated)
- `resources/views/auth/login.blade.php` - Login page (updated)

### Routes
- `routes/web.php` - Admin guru management routes (updated)

### Database
- `database/seeders/DatabaseSeeder.php` - Default users seeder (updated)

## Cara Menggunakan

### 1. Login sebagai Admin
1. Go to `/login`
2. Email: `admin@sgc.com`, Password: `password`
3. Akan redirect ke `/admin` dashboard

### 2. Tambah Guru Baru
1. Login sebagai Admin
2. Klik "Kelola Guru" atau go to `/admin/guru`
3. Klik "Tambah Guru"
4. Isi form (nama, email, password)
5. Submit - guru otomatis terverifikasi

### 3. Register Siswa Baru
1. Go to `/login`
2. Klik "Register di sini"
3. Isi form (nama, email, password)
4. Submit - siswa bisa langsung login

### 4. Login sebagai Guru/Siswa
1. Go to `/login`
2. Gunakan email dan password mereka
3. Akan redirect ke dashboard sesuai role

## Middleware Usage

Sudah konfigurasi di `bootstrap/app.php`:
```php
'role' => \App\Http\Middleware\RoleMiddleware::class,
```

Gunakan di routes:
```php
Route::middleware('role:admin')->group(...) // hanya admin
Route::middleware('role:guru')->group(...) // hanya guru
Route::middleware('role:murid')->group(...) // hanya siswa
Route::middleware('role:admin,guru')->group(...) // admin atau guru
```

## Tips Development

- Password default: `password`
- Email domain: `@sgc.com` (opsional)
- Role default saat register: `murid`
- Guru dan Admin hanya bisa dibuat admin
- Email verified otomatis untuk guru dan admin yang dibuat admin
