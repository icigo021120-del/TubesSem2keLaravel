@extends('layouts.admin')

@section('title', 'Portal Admin - Smart Disaster System')

@section('admin')
    <x-page-header title="Pusat Kendali" subtitle="Ringkasan aktivitas dan status sistem Smart Disaster System." />

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        @foreach ($stats as $s)
            <x-stat-card :val="$s['val']" :label="$s['label']" :icon="$s['icon']" :color="$s['color']" />
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
        <x-card>
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-800 text-sm">Laporan Darurat Terbaru</h3>
                <a href="{{ route('admin.laporan.index') }}" class="text-xs text-blue-600 font-semibold hover:underline">Lihat Semua</a>
            </div>

            @forelse ($recent as $r)
                <a href="{{ route('admin.laporan.show', $r) }}" class="flex items-start justify-between gap-3 p-3 bg-gray-50 rounded-xl mb-3 hover:bg-gray-100 transition-colors">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $r->user?->nama_lengkap ?? 'Pengguna dihapus' }}</p>
                        <p class="text-xs text-gray-500 truncate mt-0.5">
                            <i class="fa-solid fa-location-dot mr-1 text-red-400"></i>{{ $r->lokasi_kejadian }}
                        </p>
                        <p class="text-[10px] text-gray-400 mt-1">{{ $r->waktu_lapor->format('d M Y, H:i') }}</p>
                    </div>
                    <x-badge :value="$r->status_laporan" />
                </a>
            @empty
                <p class="text-sm text-gray-400 text-center py-6">Belum ada laporan masuk.</p>
            @endforelse
        </x-card>

        <x-card>
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-gray-800 text-sm">Peringatan Sensor Terbaru</h3>
                <a href="{{ route('admin.peringatan.index') }}" class="text-xs text-blue-600 font-semibold hover:underline">Lihat Semua</a>
            </div>

            @forelse ($recentAlerts as $a)
                @php
                    $c = match ($a->tingkat_bahaya) {
                        'awas'    => 'bg-red-50 border-red-200 text-red-700',
                        'siaga'   => 'bg-orange-50 border-orange-200 text-orange-700',
                        'waspada' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
                        default   => 'bg-gray-50 border-gray-200 text-gray-600',
                    };
                @endphp
                <div class="border rounded-xl p-3 mb-3 {{ $c }}">
                    <div class="flex justify-between items-start mb-1">
                        <p class="text-xs font-semibold">{{ $a->sensor?->lokasi_gedung ?? '-' }}</p>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-lg bg-white/60">{{ $a->tingkat_bahaya }}</span>
                    </div>
                    <p class="text-xs">{{ \Illuminate\Support\Str::limit($a->pesan_peringatan, 80) }}</p>
                    <p class="text-[10px] opacity-70 mt-1">{{ $a->waktu_kejadian->format('d M Y H:i') }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-400 text-center py-6">Tidak ada peringatan aktif.</p>
            @endforelse
        </x-card>
    </div>

    <x-card>
        <h3 class="font-bold text-gray-800 mb-5 text-sm">Aksi Cepat Admin</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $actions = [
                    ['route' => 'admin.laporan.index',    'icon' => 'fa-file-circle-plus', 'label' => 'Kelola Laporan',  'color' => 'bg-purple-50 text-purple-600 hover:border-purple-300'],
                    ['route' => 'admin.pengguna.index',   'icon' => 'fa-user-plus',        'label' => 'Data Pengguna',   'color' => 'bg-blue-50 text-blue-600 hover:border-blue-300'],
                    ['route' => 'admin.edukasi.create',   'icon' => 'fa-book-open',        'label' => 'Tambah Edukasi',  'color' => 'bg-green-50 text-green-600 hover:border-green-300'],
                    ['route' => 'admin.sensor.index',     'icon' => 'fa-map-location-dot', 'label' => 'Kelola Sensor',   'color' => 'bg-orange-50 text-orange-600 hover:border-orange-300'],
                ];
            @endphp
            @foreach ($actions as $a)
                <a href="{{ route($a['route']) }}"
                   class="border border-gray-200 rounded-2xl p-5 flex flex-col items-center justify-center gap-3 transition-all hover:shadow-md {{ $a['color'] }}">
                    <div class="w-12 h-12 rounded-xl bg-white/70 flex items-center justify-center">
                        <i class="fa-solid {{ $a['icon'] }} text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 text-center">{{ $a['label'] }}</span>
                </a>
            @endforeach
        </div>
    </x-card>
@endsection
