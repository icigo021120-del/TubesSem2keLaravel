@extends('layouts.admin')

@section('title', ($rute->exists ? 'Edit' : 'Tambah') . ' Rute Evakuasi - Admin')

@section('admin')
    <x-page-header :title="$rute->exists ? 'Edit Rute Evakuasi' : 'Tambah Rute Evakuasi'" subtitle="Tentukan asal, tujuan, dan jarak rute." />

    <x-card class="max-w-2xl">
        <form method="POST" action="{{ $rute->exists ? route('admin.rute.update', $rute) : route('admin.rute.store') }}">
            @csrf
            @if ($rute->exists) @method('PUT') @endif

            <x-input name="nama_rute" label="Nama Rute" :value="$rute->nama_rute" required />
            <x-input name="lokasi_asal" label="Lokasi Asal" :value="$rute->lokasi_asal" required />
            <x-input name="titik_kumpul" label="Titik Kumpul" :value="$rute->titik_kumpul" list="daftar-titik" required />
            <datalist id="daftar-titik">
                @foreach ($titiks as $nama)
                    <option value="{{ $nama }}"></option>
                @endforeach
            </datalist>
            <x-input name="jarak_meter" type="number" min="0" label="Jarak (meter)" :value="$rute->jarak_meter" />
            <x-textarea name="deskripsi" label="Deskripsi" :value="$rute->deskripsi" />

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                <a href="{{ route('admin.rute.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </x-card>
@endsection
