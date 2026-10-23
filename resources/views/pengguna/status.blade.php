@extends('layouts.pengguna')

@section('title', 'Status Sistem - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Status Sistem" subtitle="Kondisi seluruh sensor pemantau bencana." />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <x-card class="flex flex-col items-center justify-center text-center">
            <div class="relative w-36 h-36 mb-4">
                <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                    <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                    <path class="text-[#00875A]" stroke-dasharray="{{ $pct }}, 100" stroke-width="3" stroke-linecap="round"
                          stroke="currentColor" fill="none"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-bold text-gray-800 leading-none">{{ $pct }}%</span>
                    <span class="text-[10px] font-bold text-gray-400 tracking-wide mt-1">SENSOR AKTIF</span>
                </div>
            </div>
            <p class="text-xs text-gray-500">{{ $aktif }} dari {{ $sensors->count() }} sensor berfungsi normal.</p>
        </x-card>

        <div class="lg:col-span-2 grid grid-cols-3 gap-4">
            <x-stat-card :val="$aktif" label="Aktif" icon="fa-circle-check" color="bg-green-50 text-green-600" />
            <x-stat-card :val="$maint" label="Maintenance" icon="fa-screwdriver-wrench" color="bg-yellow-50 text-yellow-600" />
            <x-stat-card :val="$rusak" label="Rusak" icon="fa-circle-xmark" color="bg-red-50 text-red-600" />
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['Kode', 'Jenis', 'Lokasi', 'Status'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($sensors as $s)
                        <tr>
                            <td class="px-5 py-4 font-mono text-xs text-gray-700">{{ $s->kode_sensor }}</td>
                            <td class="px-5 py-4"><x-badge :value="$s->jenis_sensor" /></td>
                            <td class="px-5 py-4 text-gray-700">{{ $s->lokasi_gedung }}</td>
                            <td class="px-5 py-4"><x-badge :value="$s->status" /></td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><x-empty text="Belum ada sensor." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
