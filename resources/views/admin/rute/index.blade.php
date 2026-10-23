@extends('layouts.admin')

@section('title', 'Rute Evakuasi - Admin')

@section('admin')
    <x-page-header title="Rute Evakuasi" subtitle="Kelola jalur evakuasi dari tiap gedung menuju titik kumpul.">
        <x-slot:actions>
            <a href="{{ route('admin.rute.create') }}" class="bg-[#cc0000] hover:bg-red-800 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Rute
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['Nama Rute', 'Asal', 'Titik Kumpul', 'Jarak', 'Deskripsi', 'Aksi'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($rutes as $r)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4 font-semibold text-gray-800">{{ $r->nama_rute }}</td>
                            <td class="px-5 py-4 text-gray-700">{{ $r->lokasi_asal }}</td>
                            <td class="px-5 py-4 text-gray-700">{{ $r->titik_kumpul }}</td>
                            <td class="px-5 py-4 text-gray-700 whitespace-nowrap">{{ number_format($r->jarak_meter) }} m</td>
                            <td class="px-5 py-4 text-xs text-gray-500 max-w-[260px]"><span class="line-clamp-2">{{ $r->deskripsi }}</span></td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.rute.edit', $r) }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1"><i class="fa-solid fa-pen"></i> Edit</a>
                                    <x-delete-button :action="route('admin.rute.destroy', $r)" confirm="Hapus rute ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty text="Belum ada rute evakuasi." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
