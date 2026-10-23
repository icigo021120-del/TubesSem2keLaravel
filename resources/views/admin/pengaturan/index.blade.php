@extends('layouts.admin')

@section('title', 'Pengaturan - Admin')

@section('admin')
    <x-page-header title="Pengaturan" subtitle="Kelola profil admin, kata sandi, dan akun administrator." />

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <x-card>
            <h3 class="font-bold text-gray-800 text-sm mb-5">Profil Admin</h3>
            <form method="POST" action="{{ route('admin.pengaturan.profil') }}">
                @csrf
                @method('PUT')
                <x-input name="nama" label="Nama Lengkap" :value="$admin?->nama_lengkap" required />
                <x-input name="email_view" label="Email" :value="$admin?->email" disabled class="bg-gray-50 text-gray-500" />
                <x-input name="no_telepon" label="No. Telepon" :value="$admin?->no_telepon" />
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Simpan Profil</button>
            </form>
        </x-card>

        <x-card>
            <h3 class="font-bold text-gray-800 text-sm mb-5">Ganti Kata Sandi</h3>
            <form method="POST" action="{{ route('admin.pengaturan.password') }}">
                @csrf
                @method('PUT')
                <x-input name="password_lama" type="password" label="Kata Sandi Lama" required />
                <x-input name="password_baru" type="password" label="Kata Sandi Baru" required />
                <x-input name="konfirmasi" type="password" label="Konfirmasi Kata Sandi Baru" required />
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">Perbarui Kata Sandi</button>
            </form>
        </x-card>

        <x-card>
            <h3 class="font-bold text-gray-800 text-sm mb-5">Tambah Admin Baru</h3>
            <form method="POST" action="{{ route('admin.pengaturan.admin') }}">
                @csrf
                <x-input name="new_nama" label="Nama Lengkap" required />
                <x-input name="new_email" type="email" label="Email" required />
                <x-input name="new_password" type="password" label="Kata Sandi (min. 6 karakter)" required />
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                    <i class="fa-solid fa-user-plus mr-1"></i> Tambah Admin
                </button>
            </form>
        </x-card>

        <div class="flex flex-col gap-6">
            <x-card>
                <h3 class="font-bold text-gray-800 text-sm mb-4">Daftar Administrator</h3>
                @foreach ($adminList as $a)
                    <div class="flex items-center gap-3 py-2.5 {{ ! $loop->last ? 'border-b border-gray-50' : '' }}">
                        <div class="w-9 h-9 rounded-full bg-red-100 text-[#cc0000] font-bold text-sm flex items-center justify-center shrink-0">
                            {{ strtoupper(mb_substr($a->nama_lengkap, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $a->nama_lengkap }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $a->email }}</p>
                        </div>
                    </div>
                @endforeach
            </x-card>

            <x-card>
                <h3 class="font-bold text-gray-800 text-sm mb-4">Informasi Sistem</h3>
                <dl class="grid grid-cols-3 gap-3 text-center">
                    <div class="bg-gray-50 rounded-xl p-3"><dt class="text-[10px] text-gray-500 uppercase font-semibold">Sensor</dt><dd class="text-xl font-extrabold text-gray-800">{{ $totalSensor }}</dd></div>
                    <div class="bg-gray-50 rounded-xl p-3"><dt class="text-[10px] text-gray-500 uppercase font-semibold">Laporan</dt><dd class="text-xl font-extrabold text-gray-800">{{ $totalLaporan }}</dd></div>
                    <div class="bg-gray-50 rounded-xl p-3"><dt class="text-[10px] text-gray-500 uppercase font-semibold">Peringatan</dt><dd class="text-xl font-extrabold text-gray-800">{{ $totalAlert }}</dd></div>
                </dl>
                <p class="text-[11px] text-gray-400 mt-4">Laravel {{ app()->version() }} &middot; PHP {{ PHP_VERSION }}</p>
            </x-card>
        </div>
    </div>
@endsection
