<x-app-layout>
    <div class="py-10 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 animate-fade-in-up">

            {{-- Hero Header Simpatik Tailor --}}
            <div class="relative bg-gradient-to-br from-coklat-dark via-[#3D2518] to-coklat rounded-3xl p-8 sm:p-12 text-white shadow-xl border border-emas/25 overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(#C5A059_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
                <div class="absolute top-0 right-0 w-80 h-80 bg-emas/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div class="space-y-3">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md text-emas-light text-[11px] font-medium tracking-wider uppercase border border-emas/30">
                            <i class="fa-solid fa-scissors text-emas text-xs"></i> SIMPATIK TAILOR
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-semibold text-white tracking-tight leading-tight">
                            Selamat Datang, <span class="text-emas-light font-semibold">{{ explode(' ', auth()->user()->name)[0] }}</span> 👋
                        </h1>
                        <p class="text-xs sm:text-sm text-krem/90 max-w-lg leading-relaxed font-normal">
                            Kelola pesanan jahit pakaian Anda dengan mudah di Simpatik Tailor. Cek status pengerjaan atau buat janji pengukuran baru hari ini.
                        </p>
                    </div>

                    <a href="{{ route('bookings.create') }}"
                       class="inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-emas via-emas-light to-emas text-coklat-dark font-semibold px-6 py-3.5 rounded-2xl shadow-md hover:shadow-xl hover:scale-105 active:scale-95 transition-all text-xs tracking-wider uppercase shrink-0 border border-white/40">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Pesan Jahitan Baru</span>
                    </a>
                </div>
            </div>

            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-krem-dark/40 hover:border-emas/50 transition-all card-hover-effect relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Pesanan</span>
                        <div class="w-9 h-9 rounded-xl bg-krem text-coklat flex items-center justify-center text-xs font-semibold group-hover:bg-coklat group-hover:text-white transition-colors">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-semibold text-gray-900 mb-0.5">{{ $totalBooking }}</p>
                    <span class="text-[11px] text-gray-400 font-normal">Keseluruhan busana</span>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-krem-dark/40 hover:border-amber-300 transition-all card-hover-effect relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-semibold text-amber-700/70 uppercase tracking-wider">Menunggu</span>
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xs font-semibold group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-semibold text-amber-600 mb-0.5">{{ $menungguKonfirmasi }}</p>
                    <span class="text-[11px] text-gray-400 font-normal">Konfirmasi admin</span>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-krem-dark/40 hover:border-sky-300 transition-all card-hover-effect relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-semibold text-sky-700/70 uppercase tracking-wider">Pengerjaan</span>
                        <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xs font-semibold group-hover:bg-sky-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-scissors"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-semibold text-sky-600 mb-0.5">{{ $diproses }}</p>
                    <span class="text-[11px] text-gray-400 font-normal">Fitting & penjahitan</span>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-krem-dark/40 hover:border-emerald-300 transition-all card-hover-effect relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] font-semibold text-emerald-700/70 uppercase tracking-wider">Selesai</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs font-semibold group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-semibold text-emerald-600 mb-0.5">{{ $selesai }}</p>
                    <span class="text-[11px] text-gray-400 font-normal">Siap digunakan</span>
                </div>

            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Booking Terbaru List --}}
                <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-krem-dark/40 space-y-6">
                    <div class="flex items-center justify-between border-b border-krem-dark/20 pb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Riwayat Pesanan Terbaru</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Daftar busana yang sedang atau telah dikerjakan</p>
                        </div>
                        <a href="{{ route('bookings.index') }}"
                           class="text-xs font-medium text-coklat hover:text-coklat-dark px-3.5 py-2 rounded-xl bg-krem/50 hover:bg-krem transition-colors border border-krem-dark/30">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    @if ($bookingTerbaru->isEmpty())
                        <div class="text-center py-16 px-4 bg-[#FAF7F2] rounded-2xl border border-dashed border-krem-dark/40">
                            <div class="w-14 h-14 rounded-full bg-white text-coklat flex items-center justify-center text-xl mx-auto mb-3 shadow-xs border border-krem-dark/30">
                                <i class="fa-solid fa-shirt"></i>
                            </div>
                            <h3 class="font-semibold text-gray-900 text-sm">Belum Ada Pesanan Busana</h3>
                            <p class="text-gray-500 text-xs mt-1 mb-6 max-w-sm mx-auto">Mulai pengalaman jahit kustom pertama Anda dengan penjahit berpengalaman kami.</p>
                            <a href="{{ route('bookings.create') }}"
                               class="inline-flex items-center gap-2 bg-coklat text-white px-5 py-2.5 rounded-xl text-xs font-medium hover:bg-coklat-dark transition-all shadow">
                                <i class="fa-solid fa-plus"></i> Pesan Sekarang
                            </a>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($bookingTerbaru as $booking)
                                <a href="{{ route('bookings.show', $booking) }}"
                                   class="group flex items-center justify-between p-4 rounded-2xl border border-krem-dark/30 hover:border-emas/50 hover:bg-krem-light/40 transition-all shadow-2xs">
                                    <div class="flex items-center gap-4">
                                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-krem to-krem-dark/30 text-coklat flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition-transform shadow-2xs">
                                            <i class="{{ $booking->clothingIcon() }}"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-gray-900 text-sm group-hover:text-coklat transition-colors">
                                                    {{ $booking->booking_code }}
                                                </span>
                                                <span class="text-[10px] font-medium text-coklat bg-krem/70 px-2 py-0.5 rounded-md border border-krem-dark/30">
                                                    {{ $booking->quantity }} Pcs
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-0.5">
                                                {{ $booking->clothing_type === 'Lainnya' ? $booking->other_clothing_type : $booking->clothing_type }}
                                                &bull;
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 shrink-0">
                                        <span class="px-3.5 py-1.5 rounded-full text-xs font-medium whitespace-nowrap inline-flex items-center justify-center shrink-0 {{ $booking->statusBadgeClasses() }}">
                                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                        <i class="fa-solid fa-chevron-right text-xs text-gray-300 group-hover:text-coklat group-hover:translate-x-1 transition-all"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right: Tailor Guarantee & Quick Contact --}}
                <div class="space-y-6">

                    {{-- Card Jaminan Simpatik Tailor --}}
                    <div class="bg-gradient-to-br from-coklat-dark to-coklat text-white rounded-3xl p-6 shadow-sm border border-emas/30 relative overflow-hidden">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-xl bg-emas/20 text-emas-light flex items-center justify-center text-xs">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <h3 class="font-semibold text-sm text-emas-light">Simpatik Tailor</h3>
                        </div>
                        <p class="text-xs text-krem/90 leading-relaxed font-normal">
                            Setiap potong pakaian dijahit manual dengan presisi ukuran, kerapihan jahitan dalam, serta fitting bergaransi kepuasan.
                        </p>
                    </div>

                    {{-- WhatsApp Help --}}
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-krem-dark/40 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-xs">Konsultasi Bahan & Ukuran</h4>
                                <p class="text-[11px] text-gray-400 mt-0.5">Diskusi langsung dengan penjahit Simpatik Tailor.</p>
                            </div>
                        </div>
                        <a href="https://wa.me/6281325722366?text={{ urlencode('Halo Simpatik Tailor, saya ingin berkonsultasi seputar pesanan jahit.') }}"
                           target="_blank" rel="noopener"
                           class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-medium py-2.5 rounded-2xl text-xs transition-colors shadow-xs">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat WhatsApp Simpatik Tailor</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>