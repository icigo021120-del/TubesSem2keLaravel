@php
    $links = [
        ['landing.home',   'Beranda'],
        ['landing.tentang', 'Tentang'],
        ['landing.fitur',  'Fitur'],
    ];
@endphp

<header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-50 shadow-sm">
    <a href="{{ route('landing.home') }}" class="flex items-center gap-2">
        <i class="fa-solid fa-shield-halved text-xl text-[#cc0000]"></i>
        <h1 class="font-bold text-[#cc0000] text-sm tracking-wide">SMART DISASTER SYSTEM</h1>
    </a>

    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-500 h-full">
        @foreach ($links as [$route, $label])
            <a href="{{ route($route) }}"
               class="h-full flex items-center border-b-2 transition-colors {{ request()->routeIs($route) ? 'text-[#cc0000] border-[#cc0000] font-bold' : 'border-transparent hover:text-[#cc0000]' }}">
                {{ $label }}
            </a>
        @endforeach
    </nav>

    <div class="flex items-center gap-4 shrink-0 relative group">
        <div class="relative py-4">
            <button type="button" class="bg-[#cc0000] hover:bg-red-800 text-white text-xs font-bold px-6 py-2.5 rounded-full transition-colors shadow-md flex items-center gap-2">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Buka Aplikasi
                <i class="fa-solid fa-chevron-down text-[10px] ml-1 transition-transform group-hover:rotate-180"></i>
            </button>
            <div class="absolute right-0 top-[50px] w-48 bg-[#cc0000] rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden">
                <a href="{{ route('login.pengguna') }}" class="block px-5 py-3.5 text-xs text-white font-semibold hover:bg-red-800 border-b border-red-800/50 uppercase tracking-wider">
                    <i class="fa-solid fa-users w-5 text-center mr-1"></i> Pengguna 
                </a>
                <a href="{{ route('login.admin') }}" class="block px-5 py-3.5 text-xs text-white font-semibold hover:bg-red-800 uppercase tracking-wider">
                    <i class="fa-solid fa-user-shield w-5 text-center mr-1"></i> Admin
                </a>
            </div>
        </div>
    </div>
</header>
