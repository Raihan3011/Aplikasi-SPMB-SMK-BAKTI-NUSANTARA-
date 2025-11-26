# Implementasi Verifikasi OTP - PPDB SMK Bakti Nusantara 666

## Fitur yang Ditambahkan

### 1. Verifikasi Email dengan OTP
- Email wajib diverifikasi sebelum dapat melanjutkan pendaftaran
- Kode OTP 6 digit dikirim ke email pendaftar
- Kode berlaku selama 5 menit
- Tombol submit dinonaktifkan sampai email diverifikasi

### 2. File yang Dimodifikasi/Ditambahkan

#### Controller Baru:
- `app/Http/Controllers/OtpController.php` - Menangani pengiriman dan verifikasi OTP

#### Routes Baru:
- `POST /send-otp` - Mengirim kode OTP ke email
- `POST /verify-otp` - Memverifikasi kode OTP

#### View yang Dimodifikasi:
- `resources/views/daftar-siswa.blade.php` - Ditambahkan field OTP dan verifikasi
- `resources/views/daftar-simple.blade.php` - Ditambahkan field OTP dan verifikasi
- `resources/views/components/scripts.blade.php` - Ditambahkan jQuery

#### Email Template:
- `resources/views/emails/otp.blade.php` - Template email OTP (sudah ada)

### 3. Cara Kerja

1. **Pengiriman OTP:**
   - User memasukkan email dan klik "Kirim OTP"
   - Sistem generate kode OTP 6 digit
   - Kode disimpan di database dengan waktu kedaluwarsa 5 menit
   - Email dikirim ke user berisi kode OTP

2. **Verifikasi OTP:**
   - User memasukkan kode OTP dan klik "Verifikasi"
   - Sistem cek kode di database
   - Jika valid dan belum kedaluwarsa, email terverifikasi
   - Tombol submit diaktifkan

3. **Keamanan:**
   - Kode OTP otomatis dihapus setelah diverifikasi
   - Kode kedaluwarsa dalam 5 menit
   - Email tidak dapat diubah setelah diverifikasi

### 4. Konfigurasi Email

Pastikan konfigurasi email di `.env` sudah benar:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="SMK Bakti Nusantara 666"
```

### 5. Database

Tabel `otps` sudah ada dengan struktur:
- `id` - Primary key
- `email` - Email penerima OTP
- `otp` - Kode OTP 6 digit
- `expires_at` - Waktu kedaluwarsa
- `created_at` & `updated_at` - Timestamp

### 6. Testing

1. Buka halaman pendaftaran: `/daftar-siswa` atau `/daftar`
2. Isi email dan klik "Kirim OTP"
3. Cek email untuk kode OTP
4. Masukkan kode dan klik "Verifikasi"
5. Jika berhasil, tombol submit akan aktif

### 7. Error Handling

- Validasi email format
- Validasi kode OTP 6 digit
- Pesan error jika kode salah/kedaluwarsa
- Pesan sukses jika verifikasi berhasil