@php
    $namaUser = \App\Models\User::pengguna()?->nama_lengkap ?? 'Pengguna';

    $navItems = [
        ['route' => 'pengguna.beranda',   'label' => 'Dashboard'],
        ['route' => 'pengguna.pantauan',  'label' => 'Pantauan'],
        ['route' => 'pengguna.peta',      'label' => 'Peta Risiko'],
        ['route' => 'pengguna.rute',      'label' => 'Rute'],
        ['route' => 'pengguna.titik',     'label' => 'Titik Kumpul'],
        ['route' => 'pengguna.laporan',   'label' => 'Laporan'],
        ['route' => 'pengguna.edukasi',   'label' => 'Edukasi'],
        ['route' => 'pengguna.notifikasi', 'label' => 'Notifikasi'],
        ['route' => 'pengguna.profil',    'label' => 'Profil'],
    ];
@endphp

<header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 md:px-6 sticky top-0 z-50 shadow-sm shrink-0">
    <a href="{{ route('pengguna.beranda') }}" class="flex items-center gap-2">
        <i class="fa-solid fa-shield-halved text-xl text-[#cc0000]"></i>
        <h1 class="font-bold text-[#cc0000] text-sm tracking-wide whitespace-nowrap hidden sm:block">SMART DISASTER SYSTEM</h1>
        <h1 class="font-bold text-[#cc0000] text-xs tracking-wide whitespace-nowrap sm:hidden">SDS</h1>
    </a>

    <nav class="hidden md:flex items-center gap-3 lg:gap-5 text-xs lg:text-sm font-medium text-gray-500 h-full overflow-x-auto whitespace-nowrap px-4">
        @foreach ($navItems as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}"
               class="h-full flex items-center border-b-[3px] transition-colors {{ $active ? 'text-[#cc0000] border-[#cc0000] font-bold' : 'hover:text-[#cc0000] border-transparent' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('pengguna.notifikasi') }}" class="text-gray-400 hover:text-gray-600 relative p-1">
            <i class="fa-regular fa-bell text-lg"></i>
        </a>
        <div class="relative group">
            <button type="button" class="w-8 h-8 rounded-full bg-red-100 text-[#cc0000] flex items-center justify-center font-bold text-sm">
                {{ strtoupper(mb_substr($namaUser, 0, 1)) }}
            </button>
            <div class="absolute right-0 top-10 w-44 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100 overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-50">
                    <p class="text-xs font-bold text-gray-800 truncate">{{ $namaUser }}</p>
                    <p class="text-[10px] text-gray-400 uppercase">Pengguna</p>
                </div>
                <a href="{{ route('pengguna.profil') }}" class="block px-4 py-2.5 text-xs text-gray-600 hover:bg-gray-50 font-medium">
                    <i class="fa-solid fa-user w-4 mr-1"></i> Profil Saya
                </a>
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-xs text-gray-600 hover:bg-gray-50 font-medium">
                    <i class="fa-solid fa-gauge w-4 mr-1"></i> Portal Admin
                </a>
            </div>
        </div>

        <button type="button" id="mobileMenuBtn" class="md:hidden text-gray-500 hover:text-[#cc0000] p-1">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>
    </div>
</header>

<div id="mobileMenu" class="md:hidden hidden bg-white border-b border-gray-200 shadow-md z-40">
    <nav class="flex flex-col py-2">
        @foreach ($navItems as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}"
               class="px-6 py-3 text-sm font-medium {{ $active ? 'text-[#cc0000] bg-red-50 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full text-left px-4 py-2.5 text-xs text-red-600 hover:bg-red-50 font-medium">
        <i class="fa-solid fa-arrow-right-from-bracket w-4 mr-1"></i> Logout
    </button>
</form>
    </nav>
</div>

@push('scripts')
<script>
    document.getElementById('mobileMenuBtn')?.addEventListener('click', function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>
@endpush
