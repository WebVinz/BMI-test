<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BMI Tools</title>
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

    <!-- KANAN: Form Login -->
<div class="lg:w-2/3 w-full flex items-center justify-center bg-pink-50 px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-pink-100">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-extrabold text-pink-600">Selamat Datang </h2>
            <p class="mt-1 text-gray-500 text-sm">Masuk ke akun BMI Tools kamu</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-pink-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <x-primary-button class="w-full justify-center bg-pink-600 hover:bg-pink-700 focus:ring-pink-300">
                {{ __('Login') }}
            </x-primary-button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-pink-600 hover:underline font-medium">Daftar sekarang</a>
        </div>
    </div>
</div>

</div>

</body>
</html>
