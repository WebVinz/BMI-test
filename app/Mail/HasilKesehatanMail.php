<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HasilKesehatanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hasil;

    public function __construct($hasil) {
        $this->hasil = $hasil;
    }

    public function build() {
        return $this->subject('Hasil Kesehatan Anda');
    }
}
