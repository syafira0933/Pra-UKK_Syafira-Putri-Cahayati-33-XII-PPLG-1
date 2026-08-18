<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900">Data Layanan</h2>
    </x-slot>
    
    <div class="p-6 sm:p-8 space-y-6">
        <div class="max-w-4xl space-y-6">

            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.services.create') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-coklat-dark to-coklat text-white text-xs font-semibold px-5 py-3 rounded-2xl shadow hover:shadow-md transition-all">
                    + Tambah Layanan
                </a>
            </div>

            <div class="bg-white border border-krem-dark/40 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-[#F4ECE1] text-gray-700 font-semibold border-b border-krem-dark/30">
                            <tr>
                                <th class="px-4 py-3.5">Gambar</th>
                                <th class="px-4 py-3.5">Nama Layanan</th>
                                <th class="px-4 py-3.5">Deskripsi</th>
                                <th class="px-4 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-krem-dark/20">
                            @forelse ($services as $service)
                                <tr class="hover:bg-krem-light/40 transition-colors">
                                    <td class="px-4 py-3.5">
                                        @if ($service->image)
                                            <img src="{{ Storage::url($service->image) }}" class="w-14 h-14 object-cover rounded-xl border border-krem-dark/30">
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $service->name }}</td>
                                    <td class="px-4 py-3.5 text-gray-600 leading-relaxed">{{ Str::limit($service->description, 50) }}</td>
                                    <td class="px-4 py-3.5 text-right space-x-3">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="font-semibold text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-semibold text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-gray-400">Belum ada layanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>