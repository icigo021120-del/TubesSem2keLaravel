@extends('layouts.pengguna')

@section('title', 'Laporan Keadaan - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Laporan Keadaan Darurat" subtitle="Laporkan kejadian di sekitarmu agar tim bisa segera merespons." />

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <x-card class="lg:col-span-3">
            <form method="POST" action="{{ route('pengguna.laporan.store') }}" enctype="multipart/form-data">
                @csrf
                <x-input name="lokasi" label="Lokasi Kejadian" placeholder="Contoh: Kantin Gedung TULT" required />
                <x-textarea name="deskripsi" label="Deskripsi Kejadian" rows="5" placeholder="Ceritakan apa yang terjadi..." required />

                <div class="mb-4">
                    <label for="foto" class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Foto Bukti (opsional)</label>
                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-[#cc0000] hover:file:bg-red-100">
                    <p class="text-[11px] text-gray-400 mt-1">Format JPG/PNG, maksimal 5MB.</p>
                    @error('foto') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-[#cc0000] hover:bg-red-800 text-white font-bold py-3 px-4 rounded-xl text-sm transition-colors shadow-lg shadow-red-500/30">
                    <i class="fa-solid fa-paper-plane mr-1"></i> Kirim Laporan
                </button>
            </form>
        </x-card>

        <x-card class="lg:col-span-2">
            <h3 class="font-bold text-gray-800 text-sm mb-5">Riwayat Laporanmu</h3>
            @forelse ($riwayat as $r)
                <div class="p-3 bg-gray-50 rounded-xl mb-3">
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <p class="text-xs font-bold text-gray-800">{{ $r->lokasi_kejadian }}</p>
                        <x-badge :value="$r->status_laporan" />
                    </div>
                    <p class="text-xs text-gray-500 line-clamp-2">{{ $r->deskripsi_kejadian }}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{{ $r->waktu_lapor->format('d M Y, H:i') }}</p>
                </div>
            @empty
                <x-empty text="Belum ada laporan yang kamu kirim." icon="fa-file-circle-plus" />
            @endforelse
        </x-card>
    </div>
@endsection
