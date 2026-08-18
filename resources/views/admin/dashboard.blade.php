<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Dashboard Admin</h2>
        <p class="text-xs text-gray-400 mt-0.5">Ringkasan operasional &middot; {{ now()->format('d F Y') }}</p>
    </x-slot>

    <div class="p-6 sm:p-8 space-y-6">

        {{-- Grafik di atas --}}
        <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-krem-dark/20 pb-3">
                <p class="text-sm font-semibold text-gray-900">Booking per Bulan</p>
                <span class="text-xs font-semibold text-coklat bg-krem px-3 py-1 rounded-full border border-krem-dark/30">{{ now()->year }}</span>
            </div>
            <canvas id="bookingChart" height="90"></canvas>
        </div>

        {{-- Statistik di bawah --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-gray-400 mb-1.5">Total Pelanggan</p>
                <p class="text-2xl font-semibold text-coklat">{{ $totalPelanggan }}</p>
            </div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-gray-400 mb-1.5">Total Booking</p>
                <p class="text-2xl font-semibold text-purple-700">{{ $totalBooking }}</p>
            </div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-gray-400 mb-1.5">Booking Hari Ini</p>
                <p class="text-2xl font-semibold text-sky-600">{{ $bookingHariIni }}</p>
            </div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-amber-700/70 mb-1.5">Menunggu Konfirmasi</p>
                <p class="text-2xl font-semibold text-amber-600">{{ $menungguKonfirmasi }}</p>
            </div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-sky-700/70 mb-1.5">Sedang Dijahit</p>
                <p class="text-2xl font-semibold text-sky-600">{{ $sedangDijahit }}</p>
            </div>
            <div class="bg-white border border-krem-dark/40 rounded-3xl p-6 shadow-sm card-hover-effect">
                <p class="text-xs font-medium text-emerald-700/70 mb-1.5">Selesai</p>
                <p class="text-2xl font-semibold text-emerald-600">{{ $selesai }}</p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('bookingChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($namaBulan) !!},
                datasets: [{
                    label: 'Jumlah Booking',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: '#7A4B2A',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
    @endpush
</x-admin-layout>