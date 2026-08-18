<x-dynamic-component :component="auth()->user()->role === 'admin' ? 'admin-layout' : 'app-layout'">
    <div class="py-10 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 animate-fade-in-up">

            {{-- Header Profil --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-emas tracking-wider uppercase mb-1">
                        <i class="fa-solid fa-scissors"></i> Simpatik Tailor
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 tracking-tight">Pengaturan Profil</h1>
                    <p class="text-xs text-gray-400 mt-1">Kelola data pribadi, foto profil, dan kata sandi akun Anda.</p>
                </div>
            </div>

            {{-- Flash Alert --}}
            @if (session('status') === 'profile-updated')
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span>Perubahan profil berhasil disimpan.</span>
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span>Password akun berhasil diperbarui.</span>
                </div>
            @endif

            {{-- Main Grid Profil --}}
            <div class="grid grid-cols-1 md:grid-cols-[260px_1fr] gap-8 items-start">

                {{-- Left: Kartu Avatar User --}}
                <div class="bg-white rounded-3xl p-6 border border-krem-dark/40 shadow-sm flex flex-col items-center text-center space-y-4 relative overflow-hidden card-hover-effect">
                    
                    {{-- Decorative Top Glow --}}
                    <div class="absolute top-0 inset-x-0 h-20 bg-gradient-to-b from-krem/60 to-transparent pointer-events-none"></div>

                    {{-- Form Upload Foto Avatar --}}
                    <form id="photo-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="relative z-10">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                        <label for="photo-input" class="cursor-pointer block relative group">
                            @if (auth()->user()->photo)
                                <img src="{{ Storage::url(auth()->user()->photo) }}"
                                     class="w-24 h-24 rounded-full object-cover border-2 border-emas p-1 shadow-md group-hover:scale-105 transition-transform duration-200">
                            @else
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center text-3xl font-semibold border-2 border-emas p-1 shadow-md group-hover:scale-105 transition-transform duration-200">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-coklat text-white border-2 border-white flex items-center justify-center shadow-xs group-hover:bg-coklat-dark transition-colors">
                                <i class="fa-solid fa-camera text-xs"></i>
                            </div>
                        </label>

                        <input id="photo-input" type="file" name="photo" accept=".jpg,.jpeg,.png" class="hidden"
                               onchange="document.getElementById('photo-form').submit()">
                    </form>

                    {{-- Nama & Role Badge --}}
                    <div class="space-y-1 z-10">
                        <h3 class="font-semibold text-gray-900 text-base">{{ auth()->user()->name }}</h3>
                        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-medium bg-krem text-coklat border border-krem-dark/30 uppercase tracking-wider">
                            {{ auth()->user()->role }}
                        </span>
                    </div>

                    {{-- Total Booking Info jika Pelanggan --}}
                    @if (auth()->user()->role === 'pelanggan')
                        <div class="w-full pt-4 border-t border-krem-dark/20 text-center space-y-1">
                            <span class="text-[11px] font-medium text-gray-400 uppercase tracking-wider block">Total Pesanan Busana</span>
                            <p class="text-2xl font-semibold text-coklat">{{ auth()->user()->bookings()->count() }} Pcs</p>
                        </div>
                    @endif

                </div>

                {{-- Right: Form Data Akun & Form Password --}}
                <div class="space-y-6">

                    {{-- Card Informasi Akun --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-krem-dark/40 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 border-b border-krem-dark/20 pb-4">
                            <div class="w-9 h-9 rounded-xl bg-krem text-coklat flex items-center justify-center text-sm">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-base">Informasi Akun</h3>
                                <p class="text-xs text-gray-400">Perbarui nama, nomor handphone, dan alamat email Anda</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                           class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required
                                           class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                       class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <div class="pt-2 flex justify-end">
                                <button type="submit"
                                        class="bg-gradient-to-r from-coklat-dark to-coklat text-white font-semibold px-6 py-3 rounded-2xl text-xs hover:shadow-md hover:scale-105 active:scale-95 transition-all shadow-xs">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Card Ubah Password --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-krem-dark/40 shadow-sm space-y-6">
                        <div class="flex items-center gap-3 border-b border-krem-dark/20 pb-4">
                            <div class="w-9 h-9 rounded-xl bg-krem text-coklat flex items-center justify-center text-sm">
                                <i class="fa-solid fa-key"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-base">Keamanan & Kata Sandi</h3>
                                <p class="text-xs text-gray-400">Gunakan kata sandi yang kuat untuk menjaga keamanan akun Anda</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password"
                                       class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                                    <input type="password" name="password"
                                           class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" name="password_confirmation"
                                           class="w-full border-krem-dark/60 rounded-xl text-sm focus:border-coklat focus:ring-coklat bg-krem-light/30 p-3">
                                </div>
                            </div>

                            <div class="pt-2 flex justify-end">
                                <button type="submit"
                                        class="bg-gradient-to-r from-coklat-dark to-coklat text-white font-semibold px-6 py-3 rounded-2xl text-xs hover:shadow-md hover:scale-105 active:scale-95 transition-all shadow-xs">
                                    Update Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-dynamic-component>