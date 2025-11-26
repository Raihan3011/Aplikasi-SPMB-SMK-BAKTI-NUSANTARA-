<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class EmailService
{
    public static function sendWithTimeout($mailable, $to, $timeout = 30)
    {
        try {
            ini_set('max_execution_time', $timeout);
            
            Mail::to($to)->send($mailable);
            
            return ['success' => true, 'message' => 'Email berhasil dikirim'];
        } catch (Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            
            config(['mail.default' => 'log']);
            
            try {
                Mail::to($to)->send($mailable);
                return ['success' => true, 'message' => 'Email disimpan ke log (SMTP timeout)'];
            } catch (Exception $logError) {
                return ['success' => false, 'message' => 'Gagal mengirim email: ' . $e->getMessage()];
            }
        }
    }
}