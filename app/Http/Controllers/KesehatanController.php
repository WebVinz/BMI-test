<?php

namespace App\Http\Controllers;


use App\Mail\BmiHasilEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function hitung(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'usia' => 'required|numeric',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'aktivitas' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'email' => 'required|email',
        ]);

        // Hitung BMI
        $tinggiMeter = $data['tinggi'] / 100;
        $bmi = $data['berat'] / ($tinggiMeter * $tinggiMeter);

        // Kategori BMI
        $kategori = $this->getKategoriBMI($bmi);

        // Faktor protein
        $faktor = $this->getFaktorProtein($data['usia'], $data['aktivitas']);

        // Kebutuhan protein
        $protein = round($data['berat'] * $faktor);

        // Label aktivitas
        $aktivitas_label = [
            'sedentary' => 'Tidak aktif (jarang olahraga)',
            'ringan' => 'Aktivitas ringan',
            'sedang' => 'Lumayan aktif (olahraga 3–5x seminggu)',
            'aktif' => 'Aktif (latihan rutin)',
            'sangat_aktif' => 'Sangat aktif / latihan berat',
        ][$data['aktivitas']];

        // Rekomendasi makanan
        $rekomendasi = $this->hitungRekomendasiMakanan($protein);

        $hasil = [
            'nama' => $data['nama'],
            'usia' => $data['usia'],
            'berat' => $data['berat'],
            'tinggi' => $data['tinggi'],
            'bmi' => round($bmi, 2),
            'kategori' => $kategori,
            'protein' => $protein,
            'email' => $data['email'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'aktivitas_label' => $aktivitas_label,
            'faktor' => $faktor,
            'rekomendasi' => $rekomendasi,
        ];

        return view('hasil', compact('hasil'));
    }

    private function getKategoriBMI($bmi)
    {
        if ($bmi < 18.5) return 'Underweight';
        elseif ($bmi < 25) return 'Normal';
        elseif ($bmi < 30) return 'Overweight';
        else return 'Obese';
    }

    private function getFaktorProtein($usia, $aktivitas)
    {
        if ($usia >= 65) {
            // Lansia 65+
            return match($aktivitas) {
                'sedentary' => 1.0,
                'ringan' => 1.2,
                'sedang' => 1.4,
                'aktif' => 1.6,
                'sangat_aktif' => 2.0,
                default => 1.0,
            };
        } elseif ($usia >= 50) {
            // Dewasa 50–64
            return match($aktivitas) {
                'sedentary' => 0.8,
                'ringan' => 1.2,
                'sedang' => 1.4,
                'aktif' => 1.6,
                'sangat_aktif' => 2.0,
                default => 0.8,
            };
        } else {
            // Dewasa < 50
            return match($aktivitas) {
                'sedentary' => 0.8,
                'ringan' => 1.0,
                'sedang' => 1.2,
                'aktif' => 1.4,
                'sangat_aktif' => 1.8,
                default => 0.8,
            };
        }
    }

    private function hitungRekomendasiMakanan($target)
{
    $makanan = [
        'dada_ayam' => ['label' => 'DADA AYAM', 'per_unit' => 30, 'satuan' => 'potong'],  // contoh: 1 potong 30g
        'susu' => ['label' => 'SUSU', 'per_unit' => 27, 'satuan' => 'L'],                 // contoh: 1 liter 27g
        'telur' => ['label' => 'TELUR', 'per_unit' => 5.5, 'satuan' => 'butir'],          // contoh: 1 butir 5.5g
    ];

    return [
        [
            'nama' => $makanan['dada_ayam']['label'],
            'jumlah' => ceil($target / $makanan['dada_ayam']['per_unit']) . ' ' . $makanan['dada_ayam']['satuan'],
            'protein' => round(ceil($target / $makanan['dada_ayam']['per_unit']) * $makanan['dada_ayam']['per_unit']),
        ],
        [
            'nama' => $makanan['susu']['label'],
            'jumlah' => round($target / $makanan['susu']['per_unit'], 1) . ' ' . $makanan['susu']['satuan'],
            'protein' => round(round($target / $makanan['susu']['per_unit'], 1) * $makanan['susu']['per_unit']),
        ],
        [
            'nama' => $makanan['telur']['label'],
            'jumlah' => ceil($target / $makanan['telur']['per_unit']) . ' ' . $makanan['telur']['satuan'],
            'protein' => round(ceil($target / $makanan['telur']['per_unit']) * $makanan['telur']['per_unit']),
        ],
    ];
}
}


