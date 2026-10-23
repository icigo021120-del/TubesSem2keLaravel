@extends('layouts.admin')

@section('title', 'Detail Laporan #' . $laporan->id . ' - Admin')

@section('admin')
    <x-page-header :title="'Detail Laporan #' . $laporan->id" subtitle="Informasi lengkap laporan keadaan darurat.">
        <x-slot:actions>
            <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 bg-white hover:bg-gray-50">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <x-card class="xl:col-span-2">
            <div class="flex items-start justify-between gap-3 mb-5">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Lokasi Kejadian</p>
                    <p class="text-lg font-bold text-gray-800"><i class="fa-solid fa-location-dot text-red-400 mr-1"></i>{{ $laporan->lokasi_kejadian }}</p>
                </div>
                <x-badge :value="$laporan->status_laporan" />
            </div>

            <p class="text-xs text-gray-400 uppercase font-bold mb-1">Deskripsi</p>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line mb-6">{{ $laporan->deskripsi_kejadian }}</p>

            <p class="text-xs text-gray-400 uppercase font-bold mb-2">Foto Bukti</p>
            @if ($laporan->foto_bukti)
                <a href="{{ $laporan->fotoUrl() }}" target="_blank">
                    <img src="{{ $laporan->fotoUrl() }}" alt="Foto bukti" class="max-h-80 rounded-xl border border-gray-100">
                </a>
            @else
                <p class="text-sm text-gray-400">Tidak ada foto yang dilampirkan.</p>
            @endif
        </x-card>

        <div class="flex flex-col gap-6">
            <x-card>
                <h3 class="font-bold text-gray-800 text-sm mb-4">Pelapor</h3>
                <p class="text-sm font-semibold text-gray-800">{{ $laporan->user?->nama_lengkap ?? 'Pengguna dihapus' }}</p>
                <p class="text-xs text-gray-500">{{ $laporan->user?->email }}</p>
                <p class="text-xs text-gray-500">{{ $laporan->user?->no_telepon }}</p>
                <p class="text-[11px] text-gray-400 mt-3">Dilaporkan {{ $laporan->waktu_lapor->format('d M Y, H:i') }}</p>
            </x-card>

            <x-card>
                <h3 class="font-bold text-gray-800 text-sm mb-4">Ubah Status</h3>
                <form method="POST" action="{{ route('admin.laporan.update', $laporan) }}">
                    @csrf
                    @method('PUT')
                    @php $statusOpts = collect(\App\Models\Report::STATUS)->mapWithKeys(fn ($v) => [$v => ucfirst($v)])->all(); @endphp
                    <x-select name="status" :options="$statusOpts" :value="$laporan->status_laporan" />
                    <button type="submit" class="w-full bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan Status</button>
                </form>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <x-delete-button :action="route('admin.laporan.destroy', $laporan)" confirm="Hapus laporan ini?" label="Hapus Laporan" />
                </div>
            </x-card>
        </div>
    </div>
@endsection
