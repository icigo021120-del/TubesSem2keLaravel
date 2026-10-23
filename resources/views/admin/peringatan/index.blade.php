@extends('layouts.admin')

@section('title', 'Kelola Peringatan Sensor - Admin')

@section('admin')
    <x-page-header title="Kelola Peringatan Sensor" subtitle="Manajemen data peringatan darurat secara manual.">
        <x-slot:actions>
            <a href="{{ route('admin.peringatan.create') }}" class="bg-[#cc0000] hover:bg-red-800 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Peringatan
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tingkat Bahaya</th>
                        <th class="px-6 py-4">Pesan Peringatan</th>
                        <th class="px-6 py-4">Sensor</th>
                        <th class="px-6 py-4">Waktu Kejadian</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($alerts as $a)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4"><x-badge :value="$a->tingkat_bahaya" /></td>
                            <td class="px-6 py-4 text-gray-700 max-w-[320px]"><span class="line-clamp-2">{{ $a->pesan_peringatan }}</span></td>
                            <td class="px-6 py-4 text-xs text-gray-600">
                                @if ($a->sensor)
                                    <span class="font-mono">{{ $a->sensor->kode_sensor }}</span><br>
                                    <span class="text-gray-400">{{ $a->sensor->lokasi_gedung }}</span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">{{ $a->waktu_kejadian->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('admin.peringatan.edit', $a) }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1"><i class="fa-solid fa-pen"></i> Edit</a>
                                    <x-delete-button :action="route('admin.peringatan.destroy', $a)" confirm="Hapus peringatan ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty text="Tidak ada data peringatan." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
