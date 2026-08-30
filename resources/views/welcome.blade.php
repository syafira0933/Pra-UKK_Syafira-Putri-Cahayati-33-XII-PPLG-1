<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simpatik Tailor — Booking Jasa Jahit Online</title>

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#FAF7F2] text-gray-800 relative overflow-x-hidden" x-data="{ mobileMenu: false }">

    {{-- ===== CURSOR GLOW SPOTLIGHT ===== --}}
    <div id="cursor-glow" class="pointer-events-none fixed top-0 left-0 w-[300px] h-[300px] rounded-full z-20 opacity-0 transition-opacity duration-300 ease-out"
         style="background: radial-gradient(circle, rgba(212, 175, 55, 0.25) 0%, rgba(122, 75, 42, 0.08) 50%, transparent 75%);"></div>

    {{-- ===== NAVBAR ===== --}}
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-krem-dark/30 shadow-2xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center shadow-xs">
                    <i class="fa-solid fa-scissors text-xs text-emas"></i>
                </div>
                <div>
                    <span class="font-semibold text-base text-gray-900 leading-tight block">Simpatik Tailor</span>
                    <span class="text-[9px] font-medium text-emas tracking-wider uppercase block -mt-0.5">Jasa Jahit & Permak</span>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-xs font-medium text-gray-600">
                <a href="#home" class="hover:text-coklat transition-colors">Home</a>
                <a href="#tentang" class="hover:text-coklat transition-colors">Tentang Kami</a>
                <a href="#layanan" class="hover:text-coklat transition-colors">Layanan</a>
                <a href="#cara-pemesanan" class="hover:text-coklat transition-colors">Cara Pemesanan</a>
                <a href="#faq" class="hover:text-coklat transition-colors">FAQ</a>
                <a href="#kontak" class="hover:text-coklat transition-colors">Kontak</a>
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-xs font-medium text-gray-700 hover:text-coklat px-3 py-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-medium text-gray-700 hover:text-coklat px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-xs font-medium text-gray-700 hover:text-coklat px-3 py-2">Daftar</a>
                @endauth
                <a href="{{ auth()->check() ? route('bookings.create') : route('register') }}"
                   class="bg-coklat hover:bg-coklat-dark text-white text-xs font-medium px-5 py-2.5 rounded-2xl transition-all shadow-xs hover:shadow-md hover:scale-105 active:scale-95">
                    Booking Sekarang
                </a>
            </div>

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-gray-700 p-2">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu" x-transition class="lg:hidden border-t border-krem-dark/30 px-6 py-5 space-y-4 text-xs font-medium text-gray-700 bg-white">
            <a href="#home" class="block hover:text-coklat" @click="mobileMenu = false">Home</a>
            <a href="#tentang" class="block hover:text-coklat" @click="mobileMenu = false">Tentang Kami</a>
            <a href="#layanan" class="block hover:text-coklat" @click="mobileMenu = false">Layanan</a>
            <a href="#cara-pemesanan" class="block hover:text-coklat" @click="mobileMenu = false">Cara Pemesanan</a>
            <a href="#faq" class="block hover:text-coklat" @click="mobileMenu = false">FAQ</a>
            <a href="#kontak" class="block hover:text-coklat" @click="mobileMenu = false">Kontak</a>
            <div class="pt-4 border-t border-krem-dark/30 flex flex-col gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-center py-2 bg-krem rounded-xl text-coklat font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block text-center py-2 bg-gray-100 rounded-xl">Login</a>
                    <a href="{{ route('register') }}" class="block text-center py-2 bg-krem rounded-xl text-coklat font-semibold">Daftar</a>
                @endauth
                <a href="{{ auth()->check() ? route('bookings.create') : route('register') }}"
                   class="bg-coklat text-white text-center font-medium px-4 py-2.5 rounded-xl">Booking Sekarang</a>
            </div>
        </div>
    </header>

    {{-- ===== HERO SECTION ===== --}}
    <section id="home" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 grid lg:grid-cols-2 gap-12 items-center animate-fade-in-up">
        <div class="space-y-6 text-center lg:text-left">
            <span class="inline-flex items-center gap-2 bg-krem/70 border border-krem-dark/40 text-coklat text-xs font-medium px-4 py-2 rounded-full shadow-2xs">
                <i class="fa-solid fa-scissors text-emas"></i> Jasa Penjahit Terpercaya
            </span>
            <h1 class="text-3xl sm:text-4xl font-semibold text-gray-900 leading-tight tracking-tight">
                Jahit pakaian impianmu,<br>
                <span class="text-coklat font-semibold">tanpa ribet chat sana-sini.</span>
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                Simpatik Tailor memudahkan Anda memesan jasa jahit kustom & permak secara online. Atur jadwal pengukuran, unggah foto contoh model, dan pantau status pengerjaan secara real-time.
            </p>
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                <a href="{{ auth()->check() ? route('bookings.create') : route('register') }}"
                   class="bg-gradient-to-r from-coklat-dark to-coklat text-white font-semibold px-6 py-3.5 rounded-2xl text-xs hover:shadow-lg hover:scale-105 active:scale-95 transition-all shadow-md">
                    Booking Sekarang
                </a>
                <a href="#cara-pemesanan" class="bg-white border border-krem-dark/50 text-gray-700 font-medium px-6 py-3.5 rounded-2xl text-xs hover:bg-krem-light hover:scale-105 transition-all">
                    Cara Pemesanan 
                </a>
            </div>
        </div>

        {{-- Interactive Mock Card Preview --}}
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-tr from-krem to-emas/20 rounded-3xl -z-10 blur-xl opacity-60"></div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 sm:p-8 shadow-md space-y-5 card-hover-effect">
                <div class="flex items-center gap-4 pb-4 border-b border-krem-dark/20">
                    <div class="w-11 h-11 rounded-2xl bg-krem text-coklat flex items-center justify-center text-lg font-semibold shadow-2xs">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-medium text-emas tracking-wider uppercase block">Simpatik Order Spec</span>
                        <p class="font-semibold text-gray-900 text-sm">BOOK-20260728-A1B2</p>
                        <p class="text-xs text-gray-400 font-normal">Kebaya Kustom &bull; Jahit Baru</p>
                    </div>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="flex items-center gap-2.5 text-gray-700 font-normal">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span>1. Jadwal Pengukuran Dikonfirmasi</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-gray-700 font-normal">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span>2. Pengukuran & Fitting Selesai</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-coklat font-semibold bg-krem/60 p-2.5 rounded-xl border border-krem-dark/40">
                        <i class="fa-solid fa-scissors text-coklat"></i>
                        <span>3. Sedang Dalam Proses Penjahitan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TENTANG KAMI ===== --}}
    <section id="tentang" class="bg-white border-y border-krem-dark/30 py-16 sm:py-24 reveal-on-scroll">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div class="grid grid-cols-2 gap-5 order-2 lg:order-1">
                <div class="bg-[#FAF7F2] rounded-3xl p-6 text-center border border-krem-dark/30 card-hover-effect">
                    <p class="text-2xl font-semibold text-coklat">10+</p>
                    <p class="text-xs text-gray-500 mt-1 font-normal">Tahun Pengalaman</p>
                </div>
                <div class="bg-[#FAF7F2] rounded-3xl p-6 text-center border border-krem-dark/30 card-hover-effect">
                    <p class="text-2xl font-semibold text-amber-600">1000+</p>
                    <p class="text-xs text-gray-500 mt-1 font-normal">Pesanan Selesai</p>
                </div>
                <div class="bg-[#FAF7F2] rounded-3xl p-6 text-center border border-krem-dark/30 card-hover-effect">
                    <p class="text-2xl font-semibold text-sky-600">9</p>
                    <p class="text-xs text-gray-500 mt-1 font-normal">Kategori Busana</p>
                </div>
                <div class="bg-[#FAF7F2] rounded-3xl p-6 text-center border border-krem-dark/30 card-hover-effect">
                    <p class="text-2xl font-semibold text-emerald-600">100%</p>
                    <p class="text-xs text-gray-500 mt-1 font-normal">Dijahit Manual</p>
                </div>
            </div>

            <div class="order-1 lg:order-2 space-y-4">
                <span class="text-xs font-medium text-emas tracking-wider uppercase">Tentang Kami</span>
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 leading-tight">
                    Penjahit Langganan Keluarga, Kini Dapat Dipesan Online
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed font-normal">
                    Simpatik Tailor lahir dari pengalaman panjang melayani jahitan berkualitas tinggi. Seluruh proses booking dan pemantauan status pesanan dapat dilakukan dengan mudah lewat website ini.
                </p>
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed font-normal">
                    Harga dan proses pengukuran tetap ditentukan langsung oleh penjahit setelah pesanan dikonfirmasi, memastikan hasil jahitan selalu sesuai kebutuhanmu.
                </p>
            </div>
        </div>
    </section>

    {{-- ===== LAYANAN ===== --}}
    <section id="layanan" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-10 reveal-on-scroll">
        <div class="text-center space-y-2 max-w-xl mx-auto">
            <span class="text-xs font-medium text-emas tracking-wider uppercase">Katalog Layanan</span>
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900">Apa Yang Bisa Kami Jahitkan Untukmu</h2>
        </div>

        @if ($services->isEmpty())
            <div class="text-center text-gray-400 text-xs py-12 border border-dashed border-krem-dark/40 rounded-3xl bg-white">
                Layanan akan segera ditambahkan oleh admin.
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $service)
                    <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-xs hover:shadow-md transition-all card-hover-effect flex flex-col justify-between">
                        @if ($service->image)
                            <img src="{{ Storage::url($service->image) }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-44 bg-krem/40 flex items-center justify-center text-coklat">
                                <i class="fa-solid fa-shirt text-3xl"></i>
                            </div>
                        @endif
                        <div class="p-6 space-y-2">
                            <h3 class="font-semibold text-gray-900 text-base">{{ $service->name }}</h3>
                            <p class="text-xs text-gray-500 leading-relaxed font-normal">{{ Str::limit($service->description, 90) }}</p>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ auth()->check() ? route('bookings.create') : route('register') }}"
                               class="text-xs font-medium text-coklat hover:text-coklat-dark inline-flex items-center gap-1 group">
                                <span>Pesan Layanan Ini</span>
                                <span class="transition-transform group-hover:translate-x-1">&rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ===== CARA PEMESANAN ===== --}}
    <section id="cara-pemesanan" class="bg-white border-y border-krem-dark/30 py-16 sm:py-24 reveal-on-scroll">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="text-center space-y-2 max-w-xl mx-auto">
                <span class="text-xs font-medium text-emas tracking-wider uppercase">Cara Pemesanan</span>
                <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900">Booking Dalam 4 Langkah Mudah</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6 rounded-3xl bg-[#FAF7F2] border border-krem-dark/30 card-hover-effect space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto shadow-xs">
                        1
                    </div>
                    <h3 class="font-semibold text-gray-900 text-xs">Daftar Akun</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">Buat akun pelanggan dengan nama & nomor telepon Anda.</p>
                </div>

                <div class="text-center p-6 rounded-3xl bg-[#FAF7F2] border border-krem-dark/30 card-hover-effect space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto shadow-xs">
                        2
                    </div>
                    <h3 class="font-semibold text-gray-900 text-xs">Isi Form Booking</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">Pilih jenis pakaian, jadwal, & upload contoh foto model.</p>
                </div>

                <div class="text-center p-6 rounded-3xl bg-[#FAF7F2] border border-krem-dark/30 card-hover-effect space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto shadow-xs">
                        3
                    </div>
                    <h3 class="font-semibold text-gray-900 text-xs">Pengukuran & Fitting</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">Lakukan pengukuran di studio penjahit atau home service.</p>
                </div>

                <div class="text-center p-6 rounded-3xl bg-[#FAF7F2] border border-krem-dark/30 card-hover-effect space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-coklat text-white text-sm font-semibold flex items-center justify-center mx-auto shadow-xs">
                        4
                    </div>
                    <h3 class="font-semibold text-gray-900 text-xs">Pantau & Ambil</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">Pantau status pengerjaan secara real-time lalu ambil busana Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FAQ ===== --}}
    <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-10 reveal-on-scroll">
        <div class="text-center space-y-2">
            <span class="text-xs font-medium text-emas tracking-wider uppercase">FAQ</span>
            <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900">Pertanyaan Yang Sering Diajukan</h2>
        </div>

        <div class="space-y-4" x-data="{ open: 0 }">
            @php
                $faqs = [
                    ['q' => 'Apakah pembayaran dilakukan lewat website?', 'a' => 'Tidak. Website ini khusus untuk booking dan pemantauan status pesanan. Biaya dan pembayaran diselesaikan langsung dengan penjahit saat pengukuran/fitting.'],
                    ['q' => 'Bagaimana cara booking pengukuran di rumah (Home Service)?', 'a' => 'Layanan pengukuran di tempat pelanggan tersedia khusus untuk pemesanan minimal 15 pakaian (misal seragam keluarga/kantor/acara). Biaya transportasi dikonfirmasi admin.'],
                    ['q' => 'Bagaimana cara mengetahui status pesanan saya?', 'a' => 'Setelah akun terdaftar, Anda dapat memantau setiap tahap (Dikonfirmasi -> Pengukuran -> Sedang Dijahit -> Siap Diambil) di menu Riwayat Booking.'],
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="bg-white border border-krem-dark/40 rounded-2xl overflow-hidden shadow-2xs card-hover-effect">
                    <button @click="open = open === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between text-left px-6 py-5">
                        <span class="text-xs font-semibold text-gray-900">{{ $faq['q'] }}</span>
                        <i class="fa-solid fa-chevron-down text-coklat text-xs transition-transform duration-200"
                           :class="open === {{ $index }} ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open === {{ $index }}" x-collapse class="px-6 pb-5 text-xs text-gray-500 leading-relaxed border-t border-krem/40 pt-3 font-normal">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== KONTAK & FOOTER ===== --}}
    <footer id="kontak" class="bg-gradient-to-r from-coklat-dark via-[#3D2518] to-coklat text-white py-16 border-t border-emas/20 reveal-on-scroll">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="grid lg:grid-cols-2 gap-10 items-center border-b border-white/10 pb-12">
                <div class="space-y-4">
                    <span class="text-xs font-medium text-emas-light tracking-wider uppercase">Simpatik Tailor Semarang</span>
                    <h2 class="text-2xl sm:text-3xl font-semibold text-white leading-tight">Siap Menjahit Busana Impian Anda?</h2>
                    <p class="text-xs text-krem/80 font-normal leading-relaxed">Hubungi kami atau langsung booking lewat website untuk mulai pesanan pertamamu.</p>
                    <a href="{{ auth()->check() ? route('bookings.create') : route('register') }}"
                       class="inline-block bg-gradient-to-r from-emas to-emas-light text-coklat-dark font-semibold px-6 py-3 rounded-2xl text-xs hover:scale-105 transition-all shadow-md">
                        Booking Sekarang
                    </a>
                </div>
                <div class="space-y-3.5 text-xs text-krem/90 font-normal">
                    <p class="flex items-center gap-3"><i class="fa-solid fa-location-dot text-emas w-5"></i> Jl. Candi Penataran Selatan III No. 10, Semarang</p>
                    <p class="flex items-center gap-3"><i class="fa-solid fa-phone text-emas w-5"></i> +62 813 2572 2366</p>
                    <p class="flex items-center gap-3"><i class="fa-solid fa-envelope text-emas w-5"></i> halo@simpatiktailor.com</p>
                    <p class="flex items-center gap-3"><i class="fa-solid fa-clock text-emas w-5"></i> Senin – Sabtu, 09.00 – 17.00 WIB</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-krem/60 font-normal">
                <p>&copy; {{ date('Y') }} Simpatik Tailor. Semua hak dilindungi.</p>
                <p>Jasa Jahit & Permak Pakaian Berkualitas</p>
            </div>
        </div>
    </footer>

    {{-- Script Spotlight Cursor & Scroll Reveal --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Focused Cursor Glow (Cahaya lembut di belakang kursor)
            const glow = document.getElementById('cursor-glow');
            let mouseX = -1000, mouseY = -1000;
            let currentX = -1000, currentY = -1000;
            let isMoving = false;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                if (!isMoving) {
                    glow.style.opacity = '1';
                    isMoving = true;
                }
            });

            document.addEventListener('mouseleave', () => {
                glow.style.opacity = '0';
                isMoving = false;
            });

            function renderGlow() {
                if (isMoving || Math.abs(mouseX - currentX) > 0.1 || Math.abs(mouseY - currentY) > 0.1) {
                    currentX += (mouseX - currentX) * 0.15;
                    currentY += (mouseY - currentY) * 0.15;
                    glow.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) translate(-50%, -50%)`;
                }
                requestAnimationFrame(renderGlow);
            }
            requestAnimationFrame(renderGlow);

            // 2. Card Spotlight Hover Effect (Cahaya mengikuti kursor saat menyorot kartu)
            const updateCardSpotlight = (card, e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            };

            document.querySelectorAll('.card-hover-effect').forEach(card => {
                card.addEventListener('mousemove', (e) => updateCardSpotlight(card, e));
            });

            // 3. Scroll Reveal Animation
            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -40px 0px'
            });

            revealElements.forEach(el => observer.observe(el));
        });
    </script>

</body>
</html>