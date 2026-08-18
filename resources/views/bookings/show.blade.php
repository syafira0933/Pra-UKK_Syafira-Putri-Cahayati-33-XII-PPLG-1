<x-app-layout>
    <div class="py-10 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 animate-fade-in-up">

            {{-- Back Header --}}
            <div class="flex items-center justify-start">
                <a href="{{ route('bookings.index') }}"
                   title="Kembali"
                   class="w-10 h-10 rounded-2xl bg-white border border-krem-dark/50 text-coklat hover:bg-coklat hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs hover:shadow-sm active:scale-95 group">
                    <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                </a>
            </div>

            {{-- Container Utama Tiket Simpatik Tailor --}}
            <div class="bg-white rounded-3xl shadow-sm border border-krem-dark/40 overflow-hidden relative">
                
                {{-- Header Tiket Digital --}}
                <div class="bg-gradient-to-r from-coklat-dark via-[#3D2518] to-coklat p-8 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-emas/20">
                    <div>
                        <span class="text-[11px] text-emas-light font-semibold uppercase tracking-wider block mb-1">
                            <i class="fa-solid fa-scissors text-emas mr-1"></i> SIMPATIK TAILOR &bull; SPEC SHEET
                        </span>
                        <h1 class="text-xl sm:text-2xl font-semibold text-white">{{ $booking->booking_code }}</h1>
                        <p class="text-xs text-krem/80 mt-1 font-normal">Dibuat pada {{ $booking->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                    </div>
                    <span class="px-4 py-2 rounded-2xl text-xs font-semibold uppercase tracking-wider bg-white/10 text-white border border-white/20 self-start sm:self-auto">
                        {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>

                {{-- Status Progress Tracker --}}
                <div class="p-6 sm:p-8 border-b border-krem-dark/20 bg-krem-light/40 space-y-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress Pengerjaan Busana</h3>

                    @php
                        $statuses = [
                            'menunggu_konfirmasi' => ['label' => 'Menunggu', 'icon' => 'fa-clock'],
                            'dikonfirmasi' => ['label' => 'Dikonfirmasi', 'icon' => 'fa-circle-check'],
                            'pengukuran_selesai' => ['label' => 'Diuukur', 'icon' => 'fa-ruler'],
                            'sedang_dijahit' => ['label' => 'Dijahit', 'icon' => 'fa-scissors'],
                            'siap_diambil' => ['label' => 'Siap Diambil', 'icon' => 'fa-bag-shopping'],
                            'selesai' => ['label' => 'Selesai', 'icon' => 'fa-circle-check'],
                        ];

                        $currentIndex = match($booking->status) {
                            'menunggu_konfirmasi' => 0,
                            'dikonfirmasi' => 1,
                            'pengukuran_selesai' => 2,
                            'sedang_dijahit' => 3,
                            'siap_diambil' => 4,
                            'selesai' => 5,
                            default => 0
                        };
                    @endphp

                    <div class="grid grid-cols-2 sm:grid-cols-6 gap-2">
                        @foreach ($statuses as $key => $item)
                            @php
                                $loopIdx = array_search($key, array_keys($statuses));
                                $isDone = $loopIdx <= $currentIndex;
                                $isCurrent = $loopIdx === $currentIndex;
                            @endphp
                            <div class="flex flex-col items-center text-center p-2.5 rounded-xl border transition-all"
                                 class="{{ $isCurrent ? 'bg-coklat text-white border-coklat font-semibold shadow-xs' : ($isDone ? 'bg-krem/70 border-krem-dark text-coklat font-medium' : 'bg-white border-krem-dark/30 text-gray-400') }}">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center text-[11px] mb-1 {{ $isCurrent ? 'bg-white text-coklat' : ($isDone ? 'bg-coklat text-white' : 'bg-gray-100 text-gray-400') }}">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </div>
                                <span class="text-[10px] leading-tight">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Detail Spesifikasi --}}
                <div class="p-6 sm:p-8 space-y-6">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lembar Spesifikasi Order</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                        <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1">
                            <span class="text-gray-400 font-medium block">Jenis Busana</span>
                            <span class="text-sm font-semibold text-gray-900 block">
                                {{ $booking->clothing_type === 'Lainnya' ? $booking->other_clothing_type : $booking->clothing_type }}
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1">
                            <span class="text-gray-400 font-medium block">Jenis Layanan</span>
                            <span class="text-sm font-semibold text-gray-900 block">
                                {{ $booking->service_type === 'Lainnya' ? $booking->other_service_type : $booking->service_type }}
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1">
                            <span class="text-gray-400 font-medium block">Kuantitas</span>
                            <span class="text-sm font-semibold text-coklat block">
                                {{ $booking->quantity }} Pcs Busana
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1">
                            <span class="text-gray-400 font-medium block">Metode Pengukuran</span>
                            <span class="text-sm font-semibold text-gray-900 block">
                                {{ $booking->measurement_method === 'datang_ke_tempat' ? 'Datang ke Simpatik Tailor' : 'Home Service (Di Tempat Pelanggan)' }}
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1 md:col-span-2">
                            <span class="text-gray-400 font-medium block">Jadwal Fitting / Pengukuran</span>
                            <span class="text-sm font-semibold text-gray-900 block">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} (Jam {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB)
                            </span>
                        </div>

                        @if ($booking->address)
                            <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1 md:col-span-2">
                                <span class="text-gray-400 font-medium block">Alamat Kunjungan</span>
                                <span class="text-xs text-gray-800 leading-relaxed block font-normal">
                                    {{ $booking->address }}
                                </span>
                            </div>
                        @endif

                        @if ($booking->notes)
                            <div class="p-4 rounded-2xl bg-krem-light/40 border border-krem-dark/30 space-y-1 md:col-span-2">
                                <span class="text-gray-400 font-medium block">Catatan Tambahan Penjahit</span>
                                <p class="text-xs text-gray-700 italic bg-white p-3 rounded-xl border border-krem-dark/20 font-normal">
                                    "{{ $booking->notes }}"
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Foto Referensi --}}
                    @if ($booking->reference_image)
                        <div class="pt-4 border-t border-krem-dark/20">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-3">Foto Referensi Model Desain</span>
                            <div class="p-3 bg-krem-light/50 rounded-2xl border border-krem-dark/30 inline-block">
                                <img src="{{ Storage::url($booking->reference_image) }}"
                                     alt="Referensi Model {{ $booking->booking_code }}"
                                     class="max-h-60 object-contain rounded-xl border border-krem-dark/30">
                            </div>
                        </div>
                    @endif

                    {{-- Action Button --}}
                    <div class="pt-4 border-t border-krem-dark/20 flex flex-col sm:flex-row items-center justify-start gap-4">
                        <a href="https://wa.me/6281325722366?text={{ urlencode('Halo Simpatik Tailor, saya mau tanya tentang booking kode: ' . $booking->booking_code) }}"
                           target="_blank" rel="noopener"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-3 rounded-2xl text-xs transition-colors shadow-xs">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat Penjahit via WhatsApp</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>