<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BMI Tools</title>
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
                Daftarkan dirimu dan mulai jalani hidup sehat! BMI Tools membantu menghitung berat badan ideal dan merancang program kesehatanmu.
            </p>
            <h3 class="font-semibold text-lg mb-2">Apa yang kamu dapat?</h3>
            <ul class="text-sm space-y-2">
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Pantau BMI kamu</li>
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Saran program berat badan sehat</li>
                <li class="flex items-start gap-2"><span class="text-green-500 text-xl font-bold">✓</span> Catatan dan riwayat BMI</li>
            </ul>
        </div>
        <div class="text-xs text-gray-500 mt-6">&copy; 2025 BMI Tools</div>
    </div>

    <!-- Kanan: Form Register -->
    <div class="lg:w-2/3 w-full flex items-center justify-center bg-pink-50 px-4 py-8">
        <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-pink-100">
            <div class="mb-6 text-center">
                <h2 class="text-3xl font-extrabold text-pink-600">Buat Akun Baru</h2>
                <p class="mt-1 text-gray-500 text-sm">Daftar untuk menggunakan BMI Tools</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" name="name" type="text"
                        class="block mt-1 w-full"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email"
                        class="block mt-1 w-full"
                        :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" name="password" type="password"
                        class="block mt-1 w-full"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="block mt-1 w-full"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-pink-600 hover:underline" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="bg-pink-600 hover:bg-pink-700 focus:ring-pink-300">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
