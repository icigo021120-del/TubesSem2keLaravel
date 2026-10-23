@extends('layouts.pengguna')

@section('title', 'Titik Kumpul - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Titik Kumpul" subtitle="Area aman untuk berkumpul saat terjadi evakuasi." />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($points as $p)
            <x-card>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center"><i class="fa-solid fa-people-group"></i></div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">{{ $p->nama_titik }}</h3>
                        <p class="text-[11px] text-gray-400">Kapasitas {{ number_format($p->kapasitas) }} orang</p>
                    </div>
                </div>
                <p class="text-xs font-semibold text-gray-700 mb-2"><i class="fa-solid fa-location-dot text-red-400 mr-1"></i>{{ $p->lokasi }}</p>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $p->deskripsi }}</p>
            </x-card>
        @empty
            <div class="col-span-full"><x-card><x-empty text="Belum ada titik kumpul." /></x-card></div>
        @endforelse
    </div>
@endsection
