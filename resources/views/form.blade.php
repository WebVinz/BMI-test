<!DOCTYPE html>
<html>
<head>
    <title>Form Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-pink-600">Perhitungan BMI & Protein</h2>
        <form method="POST" action="{{ route('hitung') }}" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Nama</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Umur</label>
                <input type="number" name="usia" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Berat (kg)</label>
                <input type="number" name="berat" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Tinggi (cm)</label>
                <input type="number" name="tinggi" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Aktivitas</label>
                <select name="aktivitas" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Pilih Aktivitas --</option>
                    <option value="sedentary">Sedentary (jarang olahraga)</option>
                    <option value="ringan">Ringan (jalan santai)</option>
                    <option value="sedang">Sedang (olahraga 3-5x)</option>
                    <option value="aktif">Aktif (latihan rutin)</option>
                    <option value="sangat_aktif">Sangat Aktif (latihan berat)</option>
                </select>
            </div>

            @if (isset($bmi))
    <form action="{{ route('kirim.hasil') }}" method="POST">
        @csrf
        <input type="hidden" name="nama" value="{{ $nama }}">
        <input type="hidden" name="berat" value="{{ $berat }}">
        <input type="hidden" name="tinggi" value="{{ $tinggi }}">
        <div>
            <label>Email kamu:</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Kirim hasil ke email</button>
    </form>
@endif


            <form action="{{ route('hitung') }}" method="POST">
    @csrf
    <!-- input nama, berat, tinggi, dst -->
    <button type="submit">Hitung</button>
</form>

        </form>
    </div>
</body>
</html>
