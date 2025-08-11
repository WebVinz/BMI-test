<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Kalkulator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="min-h-screen flex flex-col lg:flex-row">

    <!-- Kiri: Informasi -->
    <div class="lg:w-1/3 w-full bg-white p-10 flex flex-col justify-between">
        <div>
            <img src="{{ asset('images/bmi-test-logo.png') }}" alt="Logo" class="h-32 mb-6">
            <h1 class="text-2xl font-bold text-pink-600 mb-2">BMI Kalkulator</h1>
            <p class="text-sm text-gray-600 mb-6">
                Berat badan ideal adalah impian semua orang. Tidak hanya menunjang penampilan, berat badan ideal juga menandakan kondisi tubuh yang sehat. Yuk, hitung sekarang di BMI Kalkulator.
            </p>
            <h3 class="font-semibold text-lg mb-2">Keunggulan fitur</h3>
            <ul class="text-sm space-y-2">
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Menghitung berat badan</li>
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Menentukan kategori berat badan ideal atau tidak</li>
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Mempersiapkan program penurunan berat badan</li>
            </ul>
        </div>
        <div class="text-xs text-gray-500 mt-6">&copy; 2025 BMI Tools</div>
    </div>

    <!-- Kanan: Form + Header -->
    <div class="lg:w-2/3 w-full p-8 bg-gray-50 flex flex-col">
        
        <!-- Header di kanan atas -->
        <div class="flex justify-end mb-6">
            @if (Route::has('login'))
                <nav class="space-x-4 text-sm">
                    @auth
                        <a href="{{ url('/') }}"
                           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
                            BMI-Test
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-semibold px-5 py-2 rounded-lg shadow">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>

        <!-- Form BMI -->
        <div class="max-w-2xl mx-auto w-full">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form method="POST" action="{{ route('hitung') }}" class="space-y-6">
                    @csrf

                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-pink-600 mb-1">Body Mass Index (BMI)</h2>
                        <p class="text-sm text-gray-500">Cara menghitung berat badan ideal berdasarkan tinggi dan berat badan.</p>
                    </div>

                    <div class="flex justify-center gap-10">
                        <label class="gender-option flex flex-col items-center cursor-pointer border-2 border-transparent rounded-lg p-2 transition duration-200">
                            <img src="{{ asset('images/man.png') }}" class="w-14 h-14 mb-1">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" class="hidden" required>
                            <span class="font-medium">Laki-laki</span>
                        </label>
                        <label class="gender-option flex flex-col items-center cursor-pointer border-2 border-transparent rounded-lg p-2 transition duration-200">
                            <img src="{{ asset('images/woman.png') }}" class="w-14 h-14 mb-1">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="hidden" required>
                            <span class="font-medium">Perempuan</span>
                        </label>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block mb-1 font-medium text-sm">Tinggi (cm)*</label>
                            <input type="number" name="tinggi" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block mb-1 font-medium text-sm">Berat (kg)*</label>
                            <input type="number" name="berat" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-sm">Nama</label>
                        <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-sm">Email</label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block mb-1 font-medium text-sm">Usia</label>
                            <input type="number" name="usia" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block mb-1 font-medium text-sm">Aktivitas</label>
                            <select name="aktivitas" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                <option value="">-- Pilih Aktivitas --</option>
                                <option value="sedentary">Sedentary (jarang olahraga)</option>
                                <option value="ringan">Ringan (jalan santai)</option>
                                <option value="sedang">Sedang (olahraga 3-5x)</option>
                                <option value="aktif">Aktif (latihan rutin)</option>
                                <option value="sangat_aktif">Sangat Aktif (latihan berat)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-lg text-lg transition duration-150">
                            Hitung BMI
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

                    <script>
                    document.querySelectorAll('.gender-option input[type="radio"]').forEach(radio => {
                        radio.addEventListener('change', () => {
                            document.querySelectorAll('.gender-option').forEach(label => {
                                label.classList.remove('border-pink-600', 'bg-pink-50');
                            });
                            if (radio.checked) {
                                radio.closest('.gender-option').classList.add('border-pink-600', 'bg-pink-50');
                            }
                        });
                    });
                    </script>
</body>
</html>
