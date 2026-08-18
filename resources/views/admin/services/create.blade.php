<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Tambah Layanan</h2>
    </x-slot>

    <div class="py-8 bg-[#FAF7F2] min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 sm:p-8 border border-krem-dark/40 shadow-sm rounded-3xl space-y-6">

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-xs space-y-1 shadow-xs">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-semibold text-xs text-gray-700 mb-1.5">Nama Layanan</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                    </div>

                    <div>
                        <label class="block font-semibold text-xs text-gray-700 mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-semibold text-xs text-gray-700 mb-1.5">Gambar</label>
                        <input type="file" name="image" accept=".jpg,.jpeg,.png" class="w-full text-xs text-gray-500 border border-krem-dark/60 rounded-xl p-2.5 bg-krem-light/30">
                    </div>

                    <div class="pt-3 flex items-center gap-3">
                        <button type="submit" class="bg-gradient-to-r from-coklat-dark to-coklat text-white text-xs font-semibold px-6 py-3 rounded-2xl shadow hover:shadow-md transition-all">
                            Simpan
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="text-xs font-medium text-gray-500 hover:text-coklat hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>