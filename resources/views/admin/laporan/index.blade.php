@extends('layouts.admin')

@section('title', 'Laporan Darurat - Admin')

@section('admin')
    <x-page-header title="Laporan Darurat" subtitle="Kelola semua laporan keadaan darurat dari pengguna." />

    <div class="flex gap-2 mb-6 flex-wrap">
        @foreach (['semua', 'menunggu', 'diproses', 'selesai', 'palsu'] as $s)
            <a href="{{ route('admin.laporan.index', ['status' => $s]) }}"
               class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ $filter === $s ? 'bg-[#cc0000] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-red-200' }}">
                {{ ucfirst($s) }}
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['#', 'Pelapor', 'Lokasi', 'Deskripsi', 'Status', 'Foto', 'Waktu', 'Aksi'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($laporan as $l)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4 text-gray-400 font-mono text-xs">#{{ $l->id }}</td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-800 text-sm">{{ $l->user?->nama_lengkap ?? '—' }}</p>
                                <p class="text-xs text-gray-400">{{ $l->user?->email }}</p>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-700 max-w-[120px] truncate">{{ $l->lokasi_kejadian }}</td>
                            <td class="px-5 py-4 text-xs text-gray-500 max-w-[180px]">
                                <span class="line-clamp-2">{{ $l->deskripsi_kejadian }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <form method="POST" action="{{ route('admin.laporan.update', $l) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()"
                                            class="text-xs px-2 py-1.5 rounded-lg border border-gray-200 font-semibold focus:outline-none bg-white">
                                        @foreach (\App\Models\Report::STATUS as $opt)
                                            <option value="{{ $opt }}" @selected($l->status_laporan === $opt)>{{ ucfirst($opt) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="px-5 py-4">
                                @if ($l->foto_bukti)
                                    <a href="{{ $l->fotoUrl() }}" target="_blank" class="text-xs text-blue-600 hover:underline flex items-center gap-1">
                                        <i class="fa-solid fa-image"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-xs text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $l->waktu_lapor->format('d M Y') }}<br>
                                <span class="text-gray-400">{{ $l->waktu_lapor->format('H:i') }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.laporan.show', $l) }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                    <x-delete-button :action="route('admin.laporan.destroy', $l)" confirm="Hapus laporan ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8"><x-empty text="Tidak ada laporan ditemukan." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
