@props(['value'])

@php
    $key = strtolower((string) $value);
    $cls = match ($key) {
        'selesai', 'aktif'                    => 'bg-green-100 text-green-700',
        'diproses', 'banjir', 'mahasiswa', 'dosen', 'staf' => 'bg-blue-100 text-blue-700',
        'menunggu', 'waspada'                 => 'bg-yellow-100 text-yellow-700',
        'siaga', 'maintenance', 'gempa'       => 'bg-orange-100 text-orange-700',
        'awas', 'rusak', 'api', 'kebakaran'   => 'bg-red-100 text-red-700',
        'admin'                               => 'bg-purple-100 text-purple-700',
        default                               => 'bg-gray-100 text-gray-600',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase shrink-0 $cls"]) }}>{{ $value }}</span>
