@extends('layouts.pengguna')

@section('title', 'Profil - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Profil Saya" subtitle="Perbarui data diri dan kata sandi." />

    @if ($user)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <x-card class="flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-full bg-red-100 text-[#cc0000] font-bold text-3xl flex items-center justify-center mb-4">
                    {{ strtoupper(mb_substr($user->nama_lengkap, 0, 1)) }}
                </div>
                <h3 class="font-bold text-gray-800">{{ $user->nama_lengkap }}</h3>
                <p class="text-xs text-gray-500 mb-3">{{ $user->email }}</p>
                <x-badge :value="$user->role" />
                <div class="mt-5 pt-5 border-t border-gray-100 w-full">
                    <p class="text-2xl font-extrabold text-gray-900">{{ $jmlLaporan }}</p>
                    <p class="text-[10px] font-semibold text-gray-500 uppercase">Laporan Dikirim</p>
                </div>
            </x-card>

            <x-card class="lg:col-span-2">
                <form method="POST" action="{{ route('pengguna.profil.update') }}">
                    @csrf
                    @method('PUT')
                    <x-input name="nama" label="Nama Lengkap" :value="$user->nama_lengkap" required />
                    <x-input name="email_view" label="Email" :value="$user->email" disabled class="bg-gray-50 text-gray-500" />
                    <x-input name="no_telepon" label="No. Telepon" :value="$user->no_telepon" />

                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <p class="text-xs text-gray-500 mb-3">Kosongkan kolom kata sandi jika tidak ingin menggantinya.</p>
                        <x-input name="password_lama" type="password" label="Kata Sandi Lama" />
                        <x-input name="password_baru" type="password" label="Kata Sandi Baru" />
                    </div>

                    <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan Perubahan</button>
                </form>
            </x-card>
        </div>
    @else
        <x-card><x-empty text="Belum ada data pengguna. Jalankan php artisan db:seed terlebih dahulu." icon="fa-user-slash" /></x-card>
    @endif
@endsection
