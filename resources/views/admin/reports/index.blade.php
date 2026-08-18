<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Laporan</h2>
    </x-slot>

    <div class="p-6 sm:p-8 space-y-6">
        <div class="max-w-4xl space-y-6">

            <div class="grid grid-cols-2 gap-5">
                <div class="bg-white p-6 rounded-3xl border border-krem-dark/40 shadow-sm card-hover-effect">
                    <p class="text-xs font-medium text-gray-400 mb-1">Total Booking</p>
                    <p class="text-2xl font-semibold text-coklat">{{ $totalBooking }}</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-krem-dark/40 shadow-sm card-hover-effect">
                    <p class="text-xs font-medium text-gray-400 mb-1">Booking Selesai</p>
                    <p class="text-2xl font-semibold text-emerald-600">{{ $bookingSelesai }}</p>
                </div>
            </div>

            <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-[#F4ECE1] text-gray-700 font-semibold border-b border-krem-dark/30">
                            <tr>
                                <th class="px-4 py-3.5">Bulan</th>
                                <th class="px-4 py-3.5">Jumlah Booking</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-krem-dark/20">
                            @forelse ($bookingPerBulan as $item)
                                <tr class="hover:bg-krem-light/40 transition-colors">
                                    <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $namaBulan[$item->bulan] }}</td>
                                    <td class="px-4 py-3.5 font-semibold text-coklat">{{ $item->jumlah }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-4 py-12 text-center text-gray-400">Belum ada data booking tahun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>