@extends('layouts.app')

@section('title', 'Registrasi - Smart Disaster System')
@section('body-class', 'min-h-screen flex items-center justify-center p-4 relative font-sans')

@section('content')
    <div class="absolute inset-0" style="background-image:url('{{ asset('images/utama.png') }}');background-size:cover;background-position:center;"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-[#0B1B3D]/90 via-slate-800/80 to-gray-900/90"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-[#cc0000] to-red-800 px-8 py-6 text-center">
                <h2 class="text-xl font-extrabold text-white tracking-wide">DAFTAR AKUN</h2>
                <p class="text-white/70 text-xs mt-1">Smart Disaster System — Telkom University</p>
            </div>

            <div class="px-8 py-8">
                <x-flash />

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <x-input name="nama" label="Nama Lengkap" required />
                    <x-input name="email" type="email" label="Email" required />
                    <x-input name="password" type="password" label="Kata Sandi (min. 6 karakter)" required />
                    <x-input name="konfirmasi_password" type="password" label="Konfirmasi Kata Sandi" required />

                    <button type="submit" class="w-full bg-[#cc0000] hover:bg-red-800 text-white font-bold py-3.5 rounded-xl text-sm transition-colors shadow-lg mt-2">
                        Daftar
                    </button>
                </form>

                <p class="mt-6 text-center text-xs text-gray-500">
                    Sudah punya akun? <a href="{{ route('login.pengguna') }}" class="text-[#cc0000] font-semibold hover:underline">Masuk</a>
                </p>
            </div>
        </div>
    </div>
@endsection