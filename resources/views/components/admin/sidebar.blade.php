@php
    $admin     = \App\Models\User::admin();
    $adminName = $admin?->nama_lengkap ?? 'Administrator';

    $nav = [
        ['route' => 'admin.dashboard',        'match' => 'admin.dashboard',    'icon' => 'fa-border-all',          'label' => 'Pusat Kendali'],
        ['route' => 'admin.laporan.index',    'match' => 'admin.laporan.*',    'icon' => 'fa-triangle-exclamation', 'label' => 'Laporan Darurat'],
        ['route' => 'admin.sensor.index',     'match' => 'admin.sensor.*',     'icon' => 'fa-satellite-dish',      'label' => 'Sensor'],
        ['route' => 'admin.rute.index',       'match' => 'admin.rute.*',       'icon' => 'fa-route',               'label' => 'Rute Evakuasi'],
        ['route' => 'admin.titik.index',      'match' => 'admin.titik.*',      'icon' => 'fa-map-pin',             'label' => 'Titik Kumpul'],
        ['route' => 'admin.peringatan.index', 'match' => 'admin.peringatan.*', 'icon' => 'fa-bell',                'label' => 'Peringatan Sensor'],
        ['route' => 'admin.edukasi.index',    'match' => 'admin.edukasi.*',    'icon' => 'fa-book-open',           'label' => 'Edukasi & Konten'],
        ['route' => 'admin.pengguna.index',   'match' => 'admin.pengguna.*',   'icon' => 'fa-users',               'label' => 'Data Pengguna'],
        ['route' => 'admin.log',              'match' => 'admin.log',          'icon' => 'fa-clock-rotate-left',   'label' => 'Log Aktivitas'],
        ['route' => 'admin.pengaturan',       'match' => 'admin.pengaturan*',  'icon' => 'fa-gear',                'label' => 'Pengaturan'],
    ];
@endphp

<aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between flex-shrink-0 z-20 h-screen sticky top-0">
    <div class="overflow-y-auto custom-scrollbar">
        <div class="px-6 py-6 border-b border-gray-50">
            <h1 class="font-extrabold text-[#cc0000] text-lg leading-tight">Portal Manajemen<br>Bencana</h1>
            <p class="text-[10px] text-gray-400 font-medium mt-1">Sistem Siaga Kampus</p>
        </div>

        <nav class="mt-5 flex flex-col gap-1 px-3 pb-4">
            @foreach ($nav as $item)
                @php $active = request()->routeIs($item['match']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ $active ? 'bg-red-50 text-[#cc0000] font-bold border-r-4 border-[#cc0000]' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
                    <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </div>

    <div class="p-5 border-t border-gray-100 flex flex-col gap-3">
        <div class="flex items-center gap-3 px-2">
            <div class="w-10 h-10 rounded-full bg-red-100 text-[#cc0000] font-bold text-sm flex items-center justify-center shrink-0">
                {{ strtoupper(mb_substr($adminName, 0, 1)) }}
            </div>
            <div>
                <h4 class="text-sm font-bold text-gray-800 truncate max-w-[120px]">{{ $adminName }}</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-gray-500 hover:text-[#cc0000] hover:bg-red-50 rounded-xl transition-colors text-sm font-medium">
        <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i> Keluar
    </button>
</form>
    </div>
</aside>
