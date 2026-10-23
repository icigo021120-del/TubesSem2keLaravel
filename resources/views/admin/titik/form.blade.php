@extends('layouts.admin')

@section('title', ($titik->exists ? 'Edit' : 'Tambah') . ' Titik Kumpul - Admin')

@section('admin')
    <x-page-header :title="$titik->exists ? 'Edit Titik Kumpul' : 'Tambah Titik Kumpul'" subtitle="Isi nama, lokasi, dan kapasitas area." />

    <x-card class="max-w-2xl">
        <form method="POST" action="{{ $titik->exists ? route('admin.titik.update', $titik) : route('admin.titik.store') }}">
            @csrf
            @if ($titik->exists) @method('PUT') @endif

            <x-input name="nama_titik" label="Nama Titik" :value="$titik->nama_titik" required />
            <x-input name="lokasi" label="Lokasi" :value="$titik->lokasi" required />
            <x-input name="kapasitas" type="number" min="0" label="Kapasitas (orang)" :value="$titik->kapasitas" />
            <x-textarea name="deskripsi" label="Deskripsi" :value="$titik->deskripsi" />

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                <a href="{{ route('admin.titik.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </x-card>
@endsection
