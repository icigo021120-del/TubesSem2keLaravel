@extends('layouts.admin')

@section('title', ($sensor->exists ? 'Edit' : 'Tambah') . ' Sensor - Admin')

@section('admin')
    @php
        $jenisOpts  = collect(\App\Models\Sensor::JENIS)->mapWithKeys(fn ($v) => [$v => ucfirst($v)])->all();
        $statusOpts = collect(\App\Models\Sensor::STATUS)->mapWithKeys(fn ($v) => [$v => ucfirst($v)])->all();
    @endphp

    <x-page-header :title="$sensor->exists ? 'Edit Sensor' : 'Tambah Sensor'" subtitle="Isi data sensor dengan lengkap." />

    <x-card class="max-w-2xl">
        <form method="POST" action="{{ $sensor->exists ? route('admin.sensor.update', $sensor) : route('admin.sensor.store') }}">
            @csrf
            @if ($sensor->exists) @method('PUT') @endif

            <x-input name="kode_sensor" label="Kode Sensor" :value="$sensor->kode_sensor" required />
            <x-select name="jenis_sensor" label="Jenis Sensor" :options="$jenisOpts" :value="$sensor->jenis_sensor" required />
            <x-input name="lokasi_gedung" label="Lokasi Gedung" :value="$sensor->lokasi_gedung" required />
            <x-select name="status" label="Status" :options="$statusOpts" :value="$sensor->status" required />

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                <a href="{{ route('admin.sensor.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </x-card>
@endsection
