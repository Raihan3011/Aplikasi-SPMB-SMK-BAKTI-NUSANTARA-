<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP - SMK Bakti Nusantara 666</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #28a745; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 30px; background: #f8f9fa; border-radius: 0 0 8px 8px; }
        .otp-box { 
            background: white; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 8px; 
            text-align: center;
            border: 2px solid #28a745;
        }
        .otp-code { 
            font-size: 32px; 
            font-weight: bold; 
            color: #28a745; 
            letter-spacing: 5px;
            margin: 10px 0;
        }
        .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SMK Bakti Nusantara 666</h1>
            <p>Kode Verifikasi OTP</p>
        </div>
        
        <div class="content">
            <h2>Kode OTP Anda</h2>
            <p>Gunakan kode OTP berikut untuk melanjutkan proses pendaftaran:</p>
            
            <div class="otp-box">
                <p>Kode OTP:</p>
                <div class="otp-code">{{ $otp }}</div>
                <small>Kode berlaku selama 5 menit</small>
            </div>
            
            <p><strong>Penting:</strong></p>
            <ul>
                <li>Jangan bagikan kode ini kepada siapa pun</li>
                <li>Kode akan kedaluwarsa dalam 5 menit</li>
                <li>Jika Anda tidak meminta kode ini, abaikan email ini</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 SMK Bakti Nusantara 666. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>