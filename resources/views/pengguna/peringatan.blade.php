@extends('layouts.pengguna')

@section('title', 'Peringatan Aktif - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Peringatan Aktif" subtitle="Peringatan tingkat siaga dan awas yang perlu kamu perhatikan." />

    <div class="space-y-4 max-w-3xl">
        @forelse ($alerts as $a)
            @php
                $c = $a->tingkat_bahaya === 'awas'
                    ? 'bg-red-50 border-red-200 text-red-700'
                    : 'bg-orange-50 border-orange-200 text-orange-700';
            @endphp
            <div class="border rounded-2xl p-5 {{ $c }}">
                <div class="flex justify-between items-start mb-2 gap-3">
                    <p class="text-sm font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $a->sensor?->lokasi_gedung ?? 'Kawasan Kampus' }}</p>
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-lg bg-white/60">{{ $a->tingkat_bahaya }}</span>
                </div>
                <p class="text-sm">{{ $a->pesan_peringatan }}</p>
                <p class="text-[11px] opacity-70 mt-2">{{ $a->waktu_kejadian->format('d M Y, H:i') }}</p>
            </div>
        @empty
            <x-card><x-empty text="Tidak ada peringatan siaga atau awas saat ini." icon="fa-circle-check" /></x-card>
        @endforelse
    </div>
@endsection
