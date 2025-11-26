# Setup Email Gmail untuk OTP

## Langkah-langkah:

### 1. Setup Gmail App Password
1. Buka https://myaccount.google.com/
2. Pilih "Security" → "2-Step Verification" (aktifkan jika belum)
3. Pilih "App passwords"
4. Generate password untuk "Mail"
5. Copy password yang dihasilkan

### 2. Update .env
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=sultanabdillah2008@gmail.com
MAIL_PASSWORD=xxxx-xxxx-xxxx-xxxx  # App password dari Gmail
MAIL_ENCRYPTION=tls
```

### 3. Test Email
Kunjungi: http://localhost:8000/test-otp

### 4. Troubleshooting
Jika masih error, cek:
- App password benar
- 2-Step verification aktif
- Less secure app access (jika perlu)

## Alternatif: Gunakan Mailtrap untuk Testing
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
```