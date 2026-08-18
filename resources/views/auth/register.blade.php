<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — Simpatik Tailor</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800">

    <div class="min-h-screen relative overflow-hidden flex flex-col items-center px-4 sm:px-6 py-10"
         style="background: radial-gradient(circle at 15% 10%, #7A4B2A 0%, #4A2E1F 50%, #3D2518 100%);">

        <div class="absolute w-72 h-72 rounded-full bg-white/5 -top-24 -right-20"></div>
        <div class="absolute w-48 h-48 rounded-full bg-white/5 -bottom-16 -left-16"></div>
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(-45deg, rgba(255,255,255,0.035) 0 2px, transparent 2px 18px);"></div>
        
        <div class="relative flex items-center gap-3 mb-2">
            <div class="w-11 h-11 rounded-xl bg-white/15 border border-white/20 backdrop-blur flex items-center justify-center text-emas text-xl">
                <i class="fa-solid fa-scissors"></i>
            </div>
            <span class="text-white font-semibold text-lg">Simpatik Tailor</span>
        </div>
        
        <p class="relative text-krem/90 text-sm mb-6">Daftar dan mulai booking jahitan pertamamu</p>

        <div class="relative flex gap-2.5 flex-wrap justify-center max-w-md mb-6">
            <span class="bg-white/10 backdrop-blur border border-white/15 text-white text-xs px-3.5 py-1.5 rounded-full flex items-center gap-1.5">
                <i class="fa-regular fa-clock text-emas"></i> Pantau real-time
            </span>
            <span class="bg-white/10 backdrop-blur border border-white/15 text-white text-xs px-3.5 py-1.5 rounded-full flex items-center gap-1.5">
                <i class="fa-regular fa-calendar text-emas"></i> Jadwal sendiri
            </span>
            <span class="bg-white/10 backdrop-blur border border-white/15 text-white text-xs px-3.5 py-1.5 rounded-full flex items-center gap-1.5">
                <i class="fa-solid fa-clock-rotate-left text-emas"></i> Riwayat rapi
            </span>
        </div>

        {{-- Kartu Form Mengambang --}}
        <div class="relative bg-white rounded-3xl p-7 sm:p-8 w-full max-w-md shadow-2xl border border-krem-dark/40">

            <div class="relative mb-1">
                <a href="{{ route('home') }}"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full border border-krem-dark/40 flex items-center justify-center text-gray-400 hover:text-coklat hover:border-coklat transition">
                     <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <p class="text-lg font-semibold text-gray-900 text-center">Buat akun baru</p>
            </div>
            <p class="text-xs text-gray-400 text-center mb-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-coklat font-semibold hover:underline">Masuk di sini</a>
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3.5">
                    <label class="text-xs font-semibold text-gray-700 block mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-xs"></i>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="w-full pl-9 text-sm border-krem-dark/50 bg-krem-light/30 rounded-xl focus:border-coklat focus:ring-coklat p-2.5">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3.5">
                    <div>
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-xs"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                   class="w-full pl-9 text-sm border-krem-dark/50 bg-krem-light/30 rounded-xl focus:border-coklat focus:ring-coklat p-2.5">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Nomor HP</label>
                        <div class="relative">
                            <i class="fa-solid fa-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-xs"></i>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel"
                                   class="w-full pl-9 text-sm border-krem-dark/50 bg-krem-light/30 rounded-xl focus:border-coklat focus:ring-coklat p-2.5">
                        </div>
                        <x-input-error :messages="$errors->get('phone')" class="mt-1.5" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <div>
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Password</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-xs"></i>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                   class="w-full pl-9 text-sm border-krem-dark/50 bg-krem-light/30 rounded-xl focus:border-coklat focus:ring-coklat p-2.5">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Konfirmasi</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-xs"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                   class="w-full pl-9 text-sm border-krem-dark/50 bg-krem-light/30 rounded-xl focus:border-coklat focus:ring-coklat p-2.5">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>
                </div>

                <button type="submit"
                        class="w-full text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2 hover:opacity-95 transition-all"
                        style="background: linear-gradient(135deg, #7A4B2A, #4A2E1F); box-shadow: 0 8px 18px rgba(74,46,31,0.25);">
                    Daftar Sekarang <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>
        </div>
    </div>
</body>
</html>