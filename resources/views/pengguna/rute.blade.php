@extends('layouts.pengguna')

@section('title', 'Rute Evakuasi - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Rute Evakuasi" subtitle="Jalur aman dari gedung menuju titik kumpul terdekat." />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($rutes as $r)
            <x-card>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-xl bg-red-50 text-[#cc0000] flex items-center justify-center"><i class="fa-solid fa-route"></i></div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">{{ $r->nama_rute }}</h3>
                        <p class="text-[11px] text-gray-400">{{ number_format($r->jarak_meter) }} meter</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600 mb-3">
                    <span class="bg-gray-100 px-2.5 py-1 rounded-lg font-semibold">{{ $r->lokasi_asal }}</span>
                    <i class="fa-solid fa-arrow-right text-gray-300"></i>
                    <span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-lg font-semibold">{{ $r->titik_kumpul }}</span>
                </div>
                <p class="text-xs text-gray-500 leading-relaxed">{{ $r->deskripsi }}</p>
            </x-card>
        @empty
            <div class="col-span-full"><x-card><x-empty text="Belum ada rute evakuasi." /></x-card></div>
        @endforelse
    </div>
@endsection
