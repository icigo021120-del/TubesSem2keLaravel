@extends('layouts.pengguna')

@section('title', 'Notifikasi - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Notifikasi" subtitle="Semua peringatan dari sensor, dari yang terbaru." />

    <x-card class="max-w-3xl">
        @forelse ($alerts as $a)
            <div class="flex items-start gap-4 py-4 {{ ! $loop->last ? 'border-b border-gray-50' : '' }}">
                <div class="w-10 h-10 rounded-xl bg-gray-50 text-gray-500 flex items-center justify-center shrink-0"><i class="fa-regular fa-bell"></i></div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <x-badge :value="$a->tingkat_bahaya" />
                        @if ($a->sensor)
                            <span class="text-[11px] text-gray-400 font-mono">{{ $a->sensor->kode_sensor }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-800">{{ $a->pesan_peringatan }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $a->sensor?->lokasi_gedung }} @if ($a->sensor) &middot; @endif {{ $a->waktu_kejadian->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        @empty
            <x-empty text="Belum ada notifikasi." icon="fa-bell-slash" />
        @endforelse
    </x-card>
@endsection
