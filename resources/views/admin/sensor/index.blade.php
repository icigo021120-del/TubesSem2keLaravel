@extends('layouts.admin')

@section('title', 'Sensor - Admin')

@section('admin')
    <x-page-header title="Manajemen Sensor" subtitle="Kelola perangkat sensor asap, api, gempa, dan banjir.">
        <x-slot:actions>
            <a href="{{ route('admin.sensor.create') }}" class="bg-[#cc0000] hover:bg-red-800 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Sensor
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['Kode', 'Jenis', 'Lokasi', 'Status', 'Terakhir Dicek', 'Aksi'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($sensors as $s)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4 font-mono text-xs text-gray-700">{{ $s->kode_sensor }}</td>
                            <td class="px-5 py-4"><x-badge :value="$s->jenis_sensor" /></td>
                            <td class="px-5 py-4 text-gray-700">{{ $s->lokasi_gedung }}</td>
                            <td class="px-5 py-4"><x-badge :value="$s->status" /></td>
                            <td class="px-5 py-4 text-xs text-gray-500">{{ $s->last_checked?->format('d M Y H:i') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.sensor.edit', $s) }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <x-delete-button :action="route('admin.sensor.destroy', $s)" confirm="Hapus sensor ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty text="Belum ada sensor." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
