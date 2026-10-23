@extends('layouts.pengguna')

@section('title', 'Pantauan Real-time - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Pantauan Real-time" subtitle="Status seluruh sensor dan peringatan terbaru di kawasan kampus." />

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        @forelse ($sensors as $s)
            @php
                $icon = match ($s->jenis_sensor) {
                    'asap' => 'fa-smog', 'api' => 'fa-fire', 'gempa' => 'fa-house-crack', 'banjir' => 'fa-water', default => 'fa-satellite-dish',
                };
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-50 text-gray-600 flex items-center justify-center"><i class="fa-solid {{ $icon }}"></i></div>
                    <x-badge :value="$s->status" />
                </div>
                <p class="text-sm font-bold text-gray-800">{{ $s->lokasi_gedung }}</p>
                <p class="text-[11px] font-mono text-gray-400 mb-2">{{ $s->kode_sensor }}</p>
                <p class="text-[11px] text-gray-500">Dicek {{ $s->last_checked?->diffForHumans() }}</p>
            </div>
        @empty
            <div class="col-span-full"><x-empty text="Belum ada sensor terpasang." /></div>
        @endforelse
    </div>

    <x-card>
        <h3 class="font-bold text-gray-800 text-sm mb-5">Peringatan Terbaru</h3>
        @forelse ($alerts as $a)
            <div class="flex items-start gap-3 py-3 {{ ! $loop->last ? 'border-b border-gray-50' : '' }}">
                <x-badge :value="$a->tingkat_bahaya" class="mt-0.5" />
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-800">{{ $a->pesan_peringatan }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $a->sensor?->lokasi_gedung ?? 'Lokasi tidak diketahui' }} &middot; {{ $a->waktu_kejadian->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        @empty
            <x-empty text="Tidak ada peringatan." icon="fa-circle-check" />
        @endforelse
    </x-card>
@endsection
