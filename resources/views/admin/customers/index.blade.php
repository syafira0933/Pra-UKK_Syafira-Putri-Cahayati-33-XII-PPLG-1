<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Data Pelanggan</h2>
    </x-slot>

    <div class="p-6 sm:p-8 space-y-6">
        <div class="max-w-4xl">
            <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-[#F4ECE1] text-gray-700 font-semibold border-b border-krem-dark/30">
                            <tr>
                                <th class="px-4 py-3.5">Nama</th>
                                <th class="px-4 py-3.5">Email</th>
                                <th class="px-4 py-3.5">No. HP</th>
                                <th class="px-4 py-3.5">Total Booking</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-krem-dark/20">
                            @forelse ($customers as $customer)
                                <tr class="hover:bg-krem-light/40 transition-colors">
                                    <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $customer->name }}</td>
                                    <td class="px-4 py-3.5 text-gray-600">{{ $customer->email }}</td>
                                    <td class="px-4 py-3.5 text-gray-600">{{ $customer->phone ?? '-' }}</td>
                                    <td class="px-4 py-3.5 font-semibold text-coklat">{{ $customer->bookings_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-gray-400">Belum ada pelanggan terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>