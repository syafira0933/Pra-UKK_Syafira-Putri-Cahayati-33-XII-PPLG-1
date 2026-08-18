<div class="w-60 h-screen sticky top-0 bg-white border-r border-krem-dark/30 flex flex-col shrink-0 overflow-y-auto shadow-2xs" x-data="{ mobileOpen: false }">
    
    {{-- Sidebar Header / Logo --}}
    <div class="flex items-center gap-2.5 px-6 py-6 border-b border-krem-dark/20">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center shadow-xs">
            <i class="fa-solid fa-scissors text-sm text-emas"></i>
        </div>
        <div>
            <span class="font-semibold text-gray-900 text-sm leading-none block">Simpatik Tailor</span>
            <span class="text-[9px] font-medium text-emas tracking-wider uppercase block mt-0.5">Admin Panel</span>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex-1 px-4 py-6 space-y-1 text-xs font-medium">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-solid fa-gauge w-4 text-center"></i> Dashboard
        </a>
        <a href="{{ route('admin.services.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.services.*') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-solid fa-shirt w-4 text-center"></i> Data Layanan
        </a>
        <a href="{{ route('admin.bookings.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.bookings.*') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-solid fa-file-lines w-4 text-center"></i> Data Booking
        </a>
        <a href="{{ route('admin.schedule.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.schedule.*') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-regular fa-calendar w-4 text-center"></i> Jadwal
        </a>
        <a href="{{ route('admin.customers.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-solid fa-users w-4 text-center"></i> Data Pelanggan
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.reports.*') ? 'bg-coklat text-white font-semibold shadow-xs' : 'text-gray-600 hover:bg-krem-light hover:text-coklat' }}">
            <i class="fa-solid fa-chart-column w-4 text-center"></i> Laporan
        </a>
    </nav>

    {{-- Bottom Profile Card --}}
    <div class="border-t border-krem-dark/30 p-4 bg-krem-light/30">
        <div class="flex items-center gap-3 px-2 py-2 mb-2">
            @if (auth()->user()->photo)
                <img src="{{ Storage::url(auth()->user()->photo) }}" class="w-9 h-9 rounded-full object-cover border border-emas shrink-0">
            @else
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-coklat-dark to-coklat text-white flex items-center justify-center text-xs font-semibold shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
            <div class="min-w-0">
                <p class="text-xs font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="text-[11px] font-medium text-coklat hover:underline">Profil</a>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-medium text-red-600 hover:bg-red-50 transition-colors">
                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-red-500"></i> Log Out
            </button>
        </form>
    </div>
</div>