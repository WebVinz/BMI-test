<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestEmailController extends Controller
{
    public function kirim()
    {
        $targetEmail = 'jokohebat194@gmail.com'; // ganti email tujuan
        $nama = 'Kevin'; // bisa dynamic dari request

        Mail::to($targetEmail)->send(new TestMail($nama));

        return "Email berhasil dikirim ke $targetEmail";
    }
}
