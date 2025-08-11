<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BmiHasilEmail;

class HasilKesehatanMail extends Controller
{
    public function kirimHasil(Request $request)
    {
        $user = Auth::user(); // Ambil user yang login

        Mail::to($user->email)->send(new BmiHasilEmail(
            $request->nama,
            $request->bmi,
            $request->kategori,
            $request->berat,
            $request->tinggi
        ));

        return response()->json(['message' => 'Email terkirim ke ' . $user->email]);
    }
}
