<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-center p-6 font-sans">

    <!-- Kategori -->
    <div class="text-green-600 text-2xl uppercase font-bold">{{ strtoupper($hasil['kategori']) }}</div>
    <div class="text-5xl font-extrabold text-gray-800 mt-2">{{ $hasil['bmi'] }}</div>

    <!-- Protein -->
    <div class="text-3xl font-bold text-indigo-800 my-4">{{ $hasil['protein'] }} G/HARI</div>

    <!-- Detail -->
    <div class="text-gray-600">{{ $hasil['jenis_kelamin'] }} - {{ $hasil['usia'] }} Tahun</div>
    <div class="text-gray-600">{{ $hasil['aktivitas_label'] }}</div>
    <div class="text-gray-600 mt-1">Faktor {{ $hasil['faktor'] }} g/kg</div>

    <!-- Rekomendasi Makanan -->
    <h3 class="text-xl font-semibold mt-10 mb-2">REKOMENDASI MAKANAN HARIAN</h3>
    <p class="text-sm text-gray-500 mb-4">Pilih kombinasi makanan untuk memenuhi {{ $hasil['protein'] }}g protein/hari</p>

    <div class="flex flex-wrap justify-center gap-4 bg-blue-50 p-6 rounded-xl">
        @php
            $ikon_map = [
                'DADA AYAM' => asset('images/chicken-leg.png'),
                'SUSU' => asset('images/milk.png'),
                'TELUR' => asset('images/boiled-egg.png'),
            ];
        @endphp

        @foreach(['DADA AYAM', 'SUSU', 'TELUR'] as $nama)
            @php
                $item = collect($hasil['rekomendasi'])->firstWhere('nama', $nama);
            @endphp
            <div class="bg-white border border-gray-300 rounded-lg p-4 w-40">
                <img src="{{ $ikon_map[$nama] }}" alt="{{ $nama }}" class="w-14 h-auto mx-auto mb-2">
                <h4 class="font-semibold">{{ $nama }}</h4>
                <p class="text-sm text-gray-700">{{ $item['jumlah'] ?? '—' }}</p>
                <strong class="text-indigo-700">{{ $item['protein'] ?? 0 }}g protein</strong>
            </div>
        @endforeach
    </div>

    <!-- Notifikasi -->
    <div id="notifEmail" class="hidden mt-6 font-semibold text-lg"></div>

    <!-- Tombol Kirim Email -->
    <form id="emailForm" class="mt-8 max-w-md mx-auto text-left">
    @csrf
    <input type="hidden" name="nama" value="{{ $hasil['nama'] ?? '' }}">
    <input type="hidden" name="berat" value="{{ $hasil['berat'] ?? '' }}">
    <input type="hidden" name="tinggi" value="{{ $hasil['tinggi'] ?? '' }}">
    <input type="hidden" name="bmi" value="{{ $hasil['bmi'] }}">
    <input type="hidden" name="kategori" value="{{ $hasil['kategori'] }}">
    <input type="hidden" name="protein" value="{{ $hasil['protein'] }}">

    <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
        Kirim Hasil ke Email Akun Saya
    </button>
</form>


    <!-- Tombol kembali -->
    <a href="/" class="inline-block mt-6 bg-pink-500 hover:bg-pink-600 text-white py-2 px-4 rounded font-semibold">
        KEMBALI
    </a>

    <!-- Script AJAX -->
    <script>
    document.getElementById('emailForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;
        const data = new FormData(form);

        fetch("{{ route('kirim.hasil') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: data
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal mengirim email');
            return response.text();
        })
        .then(() => {
            const notif = document.getElementById('notifEmail');
            notif.textContent = '✅ Hasil berhasil dikirim ke email kamu!';
            notif.classList.remove('hidden', 'text-red-600');
            notif.classList.add('text-green-600');
        })
        .catch(() => {
            const notif = document.getElementById('notifEmail');
            notif.textContent = '❌ Gagal mengirim email!';
            notif.classList.remove('hidden', 'text-green-600');
            notif.classList.add('text-red-600');
        });
    });
    </script>
</body>
</html>
