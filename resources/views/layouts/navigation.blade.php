<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-krem-dark/30 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center shadow-xs">
                            <i class="fa-solid fa-scissors text-sm text-emas"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-900 text-base leading-none block">Simpatik Tailor</span>
                            <span class="text-[9px] font-medium text-emas tracking-wider uppercase block mt-0.5">Penjahit Kustom</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                            {{ __('Data Layanan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')">
                            {{ __('Data Booking') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.schedule.index')" :active="request()->routeIs('admin.schedule.*')">
                            {{ __('Jadwal') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.*')">
                            {{ __('Data Pelanggan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                            {{ __('Laporan') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('bookings.create')" :active="request()->routeIs('bookings.create')">
                            {{ __('Booking') }}
                        </x-nav-link>
                        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')">
                            {{ __('Riwayat Booking') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="64" contentClasses="py-0 bg-white rounded-2xl shadow-xl border border-krem-dark/40 overflow-hidden">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 px-3.5 py-1.5 rounded-full border border-krem-dark/50 bg-krem-light/40 hover:bg-krem transition-all shadow-2xs group focus:outline-none cursor-pointer">
                            @if (auth()->user()->photo)
                                <img src="{{ Storage::url(auth()->user()->photo) }}" class="w-8 h-8 rounded-full object-cover border border-emas shrink-0">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center text-xs font-semibold shrink-0 shadow-2xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-xs font-semibold text-gray-800 max-w-[110px] truncate">{{ explode(' ', auth()->user()->name)[0] }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-coklat transition-transform group-hover:translate-y-0.5"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- User Header inside Dropdown --}}
                        <div class="px-4 py-3 bg-gradient-to-r from-coklat-dark via-[#3D2518] to-coklat text-white border-b border-emas/20">
                            <div class="flex items-center gap-3">
                                @if (auth()->user()->photo)
                                    <img src="{{ Storage::url(auth()->user()->photo) }}" class="w-10 h-10 rounded-full object-cover border border-white/30 shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center text-sm font-semibold shrink-0">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="overflow-hidden">
                                    <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-[11px] text-krem/80 truncate font-normal">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Menu Options --}}
                        <div class="py-1.5 text-xs font-medium text-gray-700 space-y-0.5">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-krem-light hover:text-coklat transition-colors">
                                <i class="fa-solid fa-user-gear text-coklat w-4 text-center"></i>
                                <span>Pengaturan Profil</span>
                            </x-dropdown-link>

                            <div class="border-t border-krem-dark/20 my-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center gap-2.5 px-4 py-2.5 text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-right-from-bracket text-red-500 w-4 text-center"></i>
                                    <span>Logout</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-coklat hover:bg-krem/40 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-krem-dark/30 shadow-md">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @if (auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                    {{ __('Data Layanan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.*')">
                    {{ __('Data Booking') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.schedule.index')" :active="request()->routeIs('admin.schedule.*')">
                    {{ __('Jadwal') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.*')">
                    {{ __('Data Pelanggan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings.create')" :active="request()->routeIs('bookings.create')">
                    {{ __('Booking') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')">
                    {{ __('Riwayat Booking') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options Mobile -->
        <div class="pt-4 pb-3 border-t border-krem-dark/20 px-4 bg-krem-light/30">
            <div class="flex items-center gap-3 mb-3">
                @if (auth()->user()->photo)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" class="w-10 h-10 rounded-full object-cover border border-emas shrink-0">
                @else
                    <div class="w-10 h-10 rounded-full bg-coklat text-white flex items-center justify-center font-semibold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-semibold text-sm text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="font-normal text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fa-solid fa-user-gear text-coklat mr-2"></i> {{ __('Pengaturan Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-600">
                        <i class="fa-solid fa-right-from-bracket text-red-500 mr-2"></i> {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
