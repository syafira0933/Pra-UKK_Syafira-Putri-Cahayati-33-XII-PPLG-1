<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — Simpatik Tailor</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800">

    <div class="min-h-screen grid lg:grid-cols-[1.1fr_1fr]">

        {{-- Panel Kiri --}}
        <div class="relative overflow-hidden hidden lg:flex flex-col justify-between p-10"
             style="background: radial-gradient(circle at 20% 15%, #7A4B2A 0%, #4A2E1F 55%, #3D2518 100%);">

            <div class="absolute w-64 h-64 rounded-full bg-white/5 -top-20 -right-16"></div>
            <div class="absolute w-40 h-40 rounded-full bg-white/5 bottom-10 -left-12"></div>
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(-45deg, rgba(255,255,255,0.04) 0 2px, transparent 2px 16px);"></div>

            <div class="relative flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-white/15 border border-white/20 backdrop-blur flex items-center justify-center text-emas text-xl">
                    <i class="fa-solid fa-scissors"></i>
                </div>
                <span class="text-white font-semibold text-lg">Simpatik Tailor</span>
            </div>

            <div class="relative">
                <p class="text-white text-2xl font-medium leading-tight mb-2">Booking jahitan<br>jadi lebih mudah.</p>
                <p class="text-krem/80 text-sm mb-7 max-w-xs">Pantau status pesananmu kapan saja, tanpa perlu chat sana-sini.</p>

                <div class="bg-white rounded-2xl p-4 max-w-[260px] shadow-2xl -rotate-2 border border-emas/20">
                    <div class="flex items-center gap-2.5 mb-2.5">
                        <div class="w-8 h-8 rounded-lg bg-krem text-coklat flex items-center justify-center text-sm">
                            <i class="fa-solid fa-person-dress"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-800">BOOK-20260728</p>
                            <p class="text-[10px] text-gray-400">Kebaya &middot; Jahit baru</p>
                        </div>
                    </div>
                    <span class="bg-krem text-coklat border border-krem-dark/30 text-[10px] px-2.5 py-1 rounded-full font-medium">Sedang dijahit</span>
                </div>
            </div>

            <div class="relative flex gap-1.5">
                <div class="w-5 h-0.5 rounded bg-emas"></div>
                <div class="w-1.5 h-0.5 rounded bg-white/40"></div>
                <div class="w-1.5 h-0.5 rounded bg-white/40"></div>
            </div>
        </div>

        {{-- Panel Kanan --}}
        <div class="relative overflow-hidden flex flex-col justify-center px-6 sm:px-14 py-10"
             style="background: linear-gradient(180deg, #FAF7F2 0%, #F4ECE1 100%);">

            <div class="absolute w-44 h-44 rounded-full bg-coklat/5 -top-14 -right-14"></div>
            <div class="absolute w-28 h-28 rounded-full bg-coklat/5 -bottom-10 -left-10"></div>

            <div class="relative max-w-sm mx-auto w-full">
                
            {{-- Logo mobile --}}
            <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-2.5 mb-8">
                <div class="w-10 h-10 rounded-xl bg-coklat text-white flex items-center justify-center">
                    <i class="fa-solid fa-scissors text-emas"></i>
                </div>
                <span class="font-semibold text-lg text-gray-800">Simpatik Tailor</span>
            </a>

            <a href="{{ route('home') }}" class="hidden lg:inline-flex items-center gap-1.5 text-gray-400 text-xs hover:text-coklat transition mb-5">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            <div class="w-11 h-11 rounded-xl bg-krem border border-krem-dark/30 flex items-center justify-center text-coklat text-lg mb-4">
                <i class="fa-solid fa-lock"></i>
            </div>

                <h1 class="text-xl font-semibold text-gray-900 mb-1">Selamat datang kembali</h1>
                <p class="text-sm text-gray-400 mb-2">Masuk untuk melanjutkan pesananmu</p>
                <div class="w-9 border-t-2 border-dashed border-coklat/40 mb-6"></div>

                @if (session('status'))
                    <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-lg text-sm">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-sm"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                   class="w-full pl-10 text-sm border-krem-dark/50 rounded-xl shadow-xs focus:border-coklat focus:ring-coklat bg-white p-3">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    <div class="mb-3">
                        <label class="text-xs font-semibold text-gray-700 block mb-1.5">Password</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-coklat text-sm"></i>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                   class="w-full pl-10 text-sm border-krem-dark/50 rounded-xl shadow-xs focus:border-coklat focus:ring-coklat bg-white p-3">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 text-xs font-medium text-gray-600">
                            <input type="checkbox" name="remember" class="rounded border-krem-dark/60 text-coklat focus:ring-coklat">
                            Ingat saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-coklat font-semibold hover:underline">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full text-white text-sm font-semibold py-3 rounded-xl flex items-center justify-center gap-2 hover:opacity-95 transition-all"
                            style="background: linear-gradient(135deg, #7A4B2A, #4A2E1F); box-shadow: 0 8px 18px rgba(74,46,31,0.25);">
                        Masuk <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                    <p class="text-center text-xs text-gray-500 mt-5">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-coklat font-semibold hover:underline">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>