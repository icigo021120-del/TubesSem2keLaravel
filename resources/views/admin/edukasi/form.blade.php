@extends('layouts.admin')

@section('title', ($modul->exists ? 'Edit' : 'Tambah') . ' Modul Edukasi - Admin')

@section('admin')
    @php
        $kategoriOpts = collect(\App\Models\EducationModule::KATEGORI)->mapWithKeys(fn ($v) => [$v => ucfirst($v)])->all();
    @endphp

    <x-page-header :title="$modul->exists ? 'Edit Modul Edukasi' : 'Tambah Modul Edukasi'" subtitle="Tulis materi yang mudah dipahami pengguna." />

    <x-card class="max-w-3xl">
        <form method="POST" action="{{ $modul->exists ? route('admin.edukasi.update', $modul) : route('admin.edukasi.store') }}">
            @csrf
            @if ($modul->exists) @method('PUT') @endif

            <x-input name="judul" label="Judul" :value="$modul->judul" required />
            <x-select name="kategori" label="Kategori" :options="$kategoriOpts" :value="$modul->kategori" required />
            <x-textarea name="konten" label="Konten" rows="8" :value="$modul->konten" required />

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                <a href="{{ route('admin.edukasi.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </x-card>
@endsection
