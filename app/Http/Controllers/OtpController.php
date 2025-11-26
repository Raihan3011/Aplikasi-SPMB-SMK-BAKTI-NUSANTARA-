<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $otpCode = rand(100000, 999999);

        // Hapus OTP lama untuk email ini
        Otp::where('email', $email)->delete();

        // Buat OTP baru
        Otp::create([
            'email' => $email,
            'otp' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5)
        ]);

        try {
            // Kirim email OTP
            Mail::to($email)->send(new SendOtpMail($otpCode));
            $message = 'Kode OTP telah dikirim ke email Anda';
        } catch (\Exception $e) {
            // Jika email gagal, tampilkan OTP untuk testing
            $message = 'Email gagal dikirim. Kode OTP untuk testing: ' . $otpCode;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6'
        ]);

        $otp = Otp::where('email', $request->email)
                  ->where('otp', $request->otp)
                  ->where('expires_at', '>', Carbon::now())
                  ->first();

        if ($otp) {
            // OTP valid, hapus dari database
            $otp->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Email berhasil diverifikasi'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kode OTP tidak valid atau sudah kedaluwarsa'
        ]);
    }
}