<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pendaftar;

class NotifikasiAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftar;

    public function __construct(Pendaftar $pendaftar)
    {
        $this->pendaftar = $pendaftar;
    }

    public function build()
    {
        return $this->subject('Pendaftar Baru PPDB SMK Bakti Nusantara 666')
                    ->view('emails.notifikasi-admin');
    }
}