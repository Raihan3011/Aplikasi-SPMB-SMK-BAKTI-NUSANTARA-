<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftar;

class StatusPendaftaran extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftar;
    public $status;
    public $keterangan;

    public function __construct(Pendaftar $pendaftar, $status, $keterangan = null)
    {
        $this->pendaftar = $pendaftar;
        $this->status = $status;
        $this->keterangan = $keterangan;
    }

    public function build()
    {
        $subject = $this->status === 'diterima' 
            ? 'Selamat! Anda Diterima di SMK Bakti Nusantara 666'
            : 'Pemberitahuan Status Pendaftaran PPDB';
            
        return $this->subject($subject)
                    ->view('emails.status-pendaftaran');
    }
}