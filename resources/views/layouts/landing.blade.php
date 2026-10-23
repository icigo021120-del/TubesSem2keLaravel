@extends('layouts.app')

@section('body-class', 'bg-[#F4F7FB] font-sans flex flex-col min-h-screen text-gray-800')

@section('content')
    <x-landing.header />

    <main class="flex-1 flex flex-col">
        @yield('landing')
    </main>

    <footer class="bg-white border-t border-gray-200 shrink-0">
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-gray-500">
            <div>
                <span class="font-bold text-[#cc0000] text-xs mr-1">SMART DISASTER SYSTEM</span>
                <span class="block md:inline mt-1 md:mt-0">&copy; {{ date('Y') }} Telkom University. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-5 font-medium flex-wrap justify-center">
                <a href="#" class="hover:text-gray-800">Pusat Bantuan</a>
                <a href="#" class="hover:text-gray-800">Kebijakan Privasi</a>
                <a href="{{ route('pengguna.laporan') }}" class="hover:text-gray-800">Kontak Darurat</a>
                <span class="font-semibold text-[#cc0000]">Emergency: (022) 7565930</span>
            </div>
        </div>
    </footer>
@endsection
