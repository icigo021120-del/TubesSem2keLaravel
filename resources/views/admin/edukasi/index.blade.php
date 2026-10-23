@extends('layouts.admin')

@section('title', 'Edukasi - Admin')

@section('admin')
    <x-page-header title="Edukasi & Konten" subtitle="Kelola modul edukasi kebencanaan.">
        <x-slot:actions>
            <a href="{{ route('admin.edukasi.create') }}" class="bg-[#cc0000] hover:bg-red-800 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Modul
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['Judul', 'Kategori', 'Konten', 'Dibuat', 'Aksi'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($modules as $m)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4 font-semibold text-gray-800">{{ $m->judul }}</td>
                            <td class="px-5 py-4"><x-badge :value="$m->kategori" /></td>
                            <td class="px-5 py-4 text-xs text-gray-500 max-w-[320px]"><span class="line-clamp-2">{{ $m->konten }}</span></td>
                            <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">{{ $m->created_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.edukasi.edit', $m) }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1"><i class="fa-solid fa-pen"></i> Edit</a>
                                    <x-delete-button :action="route('admin.edukasi.destroy', $m)" confirm="Hapus modul edukasi ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-empty text="Belum ada modul edukasi." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
