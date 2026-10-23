@extends('layouts.landing')

@section('title', 'Smart Disaster System - Telkom University')

@push('styles')
<style>
    @keyframes pulse-ring { 0% { transform: scale(.8); opacity: 1 } 100% { transform: scale(2.2); opacity: 0 } }
    .pulse-ring::after { content: ''; position: absolute; inset: 0; border-radius: 9999px; background: rgb(34 197 94 / .6); animation: pulse-ring 1.8s infinite; }
</style>
@endpush

@section('landing')
    <section class="relative flex-1 flex flex-col bg-slate-900 min-h-[calc(100vh-4rem)]"
             style="background-image:url('{{ asset('images/utama.png') }}');background-size:cover;background-position:center;">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0B1B3D]/95 via-[#0B1B3D]/70 to-transparent"></div>

        <div class="relative z-10 flex-1 flex flex-col justify-center max-w-7xl mx-auto px-6 lg:px-12 w-full py-16">
            <div class="inline-block bg-red-500/20 border border-red-500/30 backdrop-blur-sm px-3 py-1.5 rounded-md mb-6 self-start">
                <p class="text-red-400 text-[10px] font-bold tracking-widest uppercase flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved"></i> Smart Disaster System Telkom University
                </p>
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-3xl drop-shadow-lg">
                Siaga Dini, <span class="text-[#ffcccc]">Selamatkan Diri</span>,<br>Lindungi Kampus &amp; Sekitar
            </h2>
            <p class="text-sm md:text-base text-gray-300 max-w-2xl leading-relaxed mb-10">
                Sistem mitigasi bencana terpadu yang dirancang khusus untuk civitas akademika Telkom University dan warga sekitar guna memastikan keselamatan bersama melalui teknologi pemantauan real-time dan notifikasi cepat.
            </p>

            <div class="flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('pengguna.laporan') }}" class="w-full sm:w-auto bg-[#cc0000] hover:bg-red-800 text-white font-bold py-3.5 px-8 rounded-xl flex items-center justify-center gap-3 transition-transform hover:scale-105 shadow-lg shadow-red-500/30">
                    <i class="fa-solid fa-triangle-exclamation"></i> Lapor Darurat Sekarang
                </a>
                <a href="{{ route('landing.fitur') }}" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 border border-white/30 backdrop-blur-md text-white font-bold py-3.5 px-8 rounded-xl flex items-center justify-center gap-3 transition-colors">
                    Lihat Panduan Keselamatan
                </a>
            </div>
        </div>

        <div class="relative z-10 bg-black/40 backdrop-blur-md border-t border-white/10">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 py-4 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="relative w-3.5 h-3.5 pulse-ring">
                        <div class="w-full h-full rounded-full bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.8)]"></div>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Status Kampus</p>
                        <p class="text-sm font-bold text-white uppercase">Normal / Aman</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 text-white overflow-x-auto w-full md:w-auto pb-2 md:pb-0">
                    <div class="shrink-0">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">Suhu Rata-rata</p>
                        <p class="text-sm font-bold">28.5°C</p>
                    </div>
                    <div class="w-px h-8 bg-white/20 shrink-0 hidden sm:block"></div>
                    <div class="shrink-0">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">Kelembapan</p>
                        <p class="text-sm font-bold">68%</p>
                    </div>
                    <div class="w-px h-8 bg-white/20 shrink-0 hidden sm:block"></div>
                    <div class="shrink-0">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">Kualitas Udara</p>
                        <p class="text-sm font-bold text-green-400">Baik (AQI 42)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
