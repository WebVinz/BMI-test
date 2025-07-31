<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BmiHasilEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $bmi;
    public $kategori;
    public $berat;
    public $tinggi;

    public function __construct($nama, $bmi, $kategori, $berat, $tinggi)
    {
        $this->nama = $nama;
        $this->bmi = $bmi;
        $this->kategori = $kategori;
        $this->berat = $berat;
        $this->tinggi = $tinggi;
    }

    public function build()
    {
        return $this->subject('Hasil Tes BMI Kamu')
                    ->view('emails.bmi_hasil');
    }
}
