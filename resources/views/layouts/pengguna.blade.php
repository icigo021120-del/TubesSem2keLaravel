@extends('layouts.app')

@section('body-class', 'bg-[#F4F7FB] font-sans flex flex-col min-h-screen text-gray-800')

@section('content')
    <x-pengguna.navbar />

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 md:px-8 py-8">
        <x-flash />
        @yield('pengguna')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <div><span class="font-bold text-[#cc0000] mr-2">SDS</span> &copy; {{ date('Y') }} Telkom University.</div>
            <div class="flex items-center gap-5">
                <a href="#" class="hover:text-gray-800">Pusat Bantuan</a>
                <a href="#" class="hover:text-gray-800">Kebijakan Privasi</a>
                <span class="font-semibold text-[#cc0000]">Emergency: (022) 7565930</span>
            </div>
        </div>
    </footer>
@endsection
