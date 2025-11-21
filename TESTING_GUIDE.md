# Testing Checklist - Sistem Role-Based SGC

## Login Test

### 1. Login Admin
- URL: http://127.0.0.1:8000/login
- Email: `admin@sgc.com`
- Password: `password`
- Expected: Redirect ke `/admin` dashboard

### 2. Login Guru
- URL: http://127.0.0.1:8000/login
- Email: `guru@sgc.com`
- Password: `password`
- Expected: Redirect ke `/guru` dashboard

### 3. Login Siswa
- URL: http://127.0.0.1:8000/login
- Email: `siswa@sgc.com`
- Password: `password`
- Expected: Redirect ke `/murid` dashboard

## Register Test

### 1. Buka Register Page
- URL: http://127.0.0.1:8000/login
- Klik "Register di sini"
- Expected: Masuk ke form register dengan role otomatis "siswa"

### 2. Daftar Siswa Baru
- Isi: Nama, Email, Password (2x)
- Click Submit
- Expected: Auto login dan redirect ke `/murid` dashboard

### 3. Cek Email Register
- Lihat di database: role harus "murid"
- Email harus unique

## Admin Features Test

### 1. Kelola Guru - List
- Login sebagai admin
- Go to: `/admin/guru` atau klik "Kelola Guru" di dashboard
- Expected: Tampil tabel daftar guru (Guru Test ada)

### 2. Kelola Guru - Tambah
- Click "Tambah Guru"
- Isi form (Nama, Email baru, Password 2x)
- Submit
- Expected: Guru berhasil ditambah dan tampil di list

### 3. Kelola Guru - Edit
- Klik tombol "Edit" pada guru
- Ubah nama atau password
- Submit
- Expected: Perubahan disimpan dan kembali ke list

### 4. Kelola Guru - Hapus
- Klik tombol "Hapus" pada guru
- Confirm dialog
- Expected: Guru dihapus dari database

## Role Protection Test

### 1. Akses /admin (tidak login)
- URL: http://127.0.0.1:8000/admin
- Expected: Redirect ke login

### 2. Akses /admin (login sebagai siswa)
- Login sebagai siswa
- URL: http://127.0.0.1:8000/admin
- Expected: Error 403 atau redirect

### 3. Akses /murid (login sebagai guru)
- Login sebagai guru
- URL: http://127.0.0.1:8000/murid
- Expected: Error 403 atau redirect

## Database Verification

```sql
SELECT id, name, email, role FROM users;
```

Expected:
- Admin: admin@sgc.com (role: admin)
- Guru Test: guru@sgc.com (role: guru)
- Siswa Test: siswa@sgc.com (role: murid)
- Guru/Siswa baru yang dibuat (sesuai role)

## API Routes (untuk development)

```
// Admin Routes
GET  /admin/guru                 # List guru
GET  /admin/guru/create          # Form create
POST /admin/guru                 # Store guru
GET  /admin/guru/{id}/edit       # Form edit
PATCH /admin/guru/{id}           # Update guru
DELETE /admin/guru/{id}          # Delete guru

// Dashboard Routes
GET /dashboard                   # Auto-redirect based on role
GET /admin                       # Admin dashboard
GET /guru                        # Guru dashboard
GET /murid                       # Siswa dashboard

// Auth Routes
GET  /login                      # Login page
POST /login                      # Process login
GET  /register                   # Register page (siswa only)
POST /register                   # Process register
GET  /logout                     # Logout
```

## Troubleshooting

### Issue: "View [partials.nav] not found"
- Solution: Already fixed. Partials exist at `resources/views/partials/`

### Issue: 404 on /admin/guru
- Check: Route is registered in web.php with correct prefix
- Check: GuruController.php exists at app/Http/Controllers/Admin/

### Issue: Role middleware not working
- Check: RoleMiddleware.php exists at app/Http/Middleware/
- Check: Registered in bootstrap/app.php as 'role' alias
- Check: User model has 'role' column and it's in fillable array

### Issue: Guru baru tidak bisa login
- Check: Password di hash dengan Hash::make()
- Check: Role di set ke 'guru'
- Check: Email verified_at di set ke now()

## Performance Tips

- Use Laravel Debugbar untuk debug queries
- Check N+1 queries di list guru
- Add pagination untuk many gurus
- Cache dashboard stats jika ada many users
