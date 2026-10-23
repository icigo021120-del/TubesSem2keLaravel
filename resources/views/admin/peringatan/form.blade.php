@extends('layouts.admin')

@section('title', ($alert->exists ? 'Edit' : 'Tambah') . ' Peringatan - Admin')

@section('admin')
    @php
        $tingkatOpts = collect(\App\Models\Alert::TINGKAT)->mapWithKeys(fn ($v) => [$v => ucfirst($v)])->all();
        $sensorOpts  = ['' => '— Tanpa sensor —'] + $sensors->mapWithKeys(fn ($s) => [$s->id => $s->kode_sensor . ' — ' . $s->lokasi_gedung])->all();
    @endphp

    <x-page-header :title="$alert->exists ? 'Edit Peringatan' : 'Tambah Peringatan'" subtitle="Peringatan akan tampil di sisi pengguna." />

    <x-card class="max-w-2xl">
        <form method="POST" action="{{ $alert->exists ? route('admin.peringatan.update', $alert) : route('admin.peringatan.store') }}">
            @csrf
            @if ($alert->exists) @method('PUT') @endif

            <x-select name="sensor_id" label="Sensor" :options="$sensorOpts" :value="$alert->sensor_id" />
            <x-select name="tingkat_bahaya" label="Tingkat Bahaya" :options="$tingkatOpts" :value="$alert->tingkat_bahaya" required />
            <x-textarea name="pesan_peringatan" label="Pesan Peringatan" :value="$alert->pesan_peringatan" required />

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan</button>
                <a href="{{ route('admin.peringatan.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 border border-gray-200 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </x-card>
@endsection
