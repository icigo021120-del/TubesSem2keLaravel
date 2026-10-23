@extends('layouts.app')

@section('title', ($admin ? 'Login Admin' : 'Login Pengguna') . ' - Smart Disaster System')
@section('body-class', 'min-h-screen flex items-center justify-center p-4 relative font-sans')

@section('content')
    <div class="absolute inset-0" style="background-image:url('{{ asset('images/utama.png') }}');background-size:cover;background-position:center;"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-[#0B1B3D]/90 via-slate-800/80 to-gray-900/90"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="{{ $admin ? 'bg-gradient-to-r from-gray-800 to-gray-900' : 'bg-gradient-to-r from-[#cc0000] to-red-800' }} px-8 py-7 text-center">
                <i class="fa-solid {{ $admin ? 'fa-user-shield' : 'fa-shield-halved' }} text-white text-4xl mb-3 block"></i>
                <h2 class="text-xl font-extrabold text-white tracking-wide">{{ $admin ? 'PORTAL ADMIN' : 'SMART DISASTER SYSTEM' }}</h2>
                <p class="text-white/70 text-xs mt-1">Telkom University</p>
            </div>

            <div class="px-8 py-8">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $admin ? 'Akses Administrator' : 'Masuk ke Akun' }}</h3>
                <p class="text-xs text-gray-500 mb-6">{{ $admin ? 'Hanya untuk petugas berwenang.' : 'Gunakan email dan kata sandi kamu.' }}</p>

                <x-flash />

                <form method="POST" action="{{ $admin ? route('login.admin.submit') : route('login.pengguna.submit') }}">
                    @csrf
                    <x-input name="email" type="email" label="Email" required />
                    <x-input name="password" type="password" label="Kata Sandi" required />

                    <button type="submit" class="w-full {{ $admin ? 'bg-gray-900 hover:bg-gray-700' : 'bg-[#cc0000] hover:bg-red-800' }} text-white font-bold py-3.5 rounded-xl text-sm transition-colors shadow-lg mt-2">
                        <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> Masuk
                    </button>
                </form>

                <div class="mt-6 text-center text-xs text-gray-500 space-y-2">
                    @unless ($admin)
                        <p>Belum punya akun? <a href="{{ route('register') }}" class="text-[#cc0000] font-semibold hover:underline">Daftar</a></p>
                    @endunless
                    <a href="{{ route('landing.home') }}" class="text-gray-600 font-semibold hover:underline block">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection