@extends('layouts.landing')

@section('title', 'Fitur Utama - Smart Disaster System')

@section('landing')
    @php
        $features = [
            ['fa-satellite-dish', 'bg-blue-50 text-blue-600', 'Pemantauan Sensor Real-time', 'Monitor status seluruh sensor keselamatan di setiap gedung kampus secara real-time, termasuk sensor asap, api, gempa, dan banjir.'],
            ['fa-triangle-exclamation', 'bg-red-50 text-red-600', 'Sistem Peringatan Dini', 'Notifikasi dan peringatan otomatis ketika sensor mendeteksi anomali, dengan tingkat prioritas: Waspada, Siaga, dan Awas.'],
            ['fa-file-circle-exclamation', 'bg-orange-50 text-orange-600', 'Laporan Darurat', 'Pengguna dapat mengirimkan laporan keadaan darurat disertai foto bukti langsung dari perangkat mobile maupun desktop.'],
            ['fa-map-location-dot', 'bg-purple-50 text-purple-600', 'Peta Risiko Kampus', 'Visualisasi interaktif zona risiko dan lokasi sensor di seluruh area kampus untuk navigasi evakuasi yang lebih mudah.'],
            ['fa-route', 'bg-green-50 text-green-600', 'Rute Evakuasi', 'Panduan jalur evakuasi yang sudah terstandarisasi dari setiap gedung menuju titik kumpul terdekat yang aman.'],
            ['fa-users', 'bg-teal-50 text-teal-600', 'Titik Kumpul', 'Informasi lengkap lokasi dan kapasitas titik kumpul resmi sebagai tujuan evakuasi yang telah ditetapkan.'],
            ['fa-book-open', 'bg-yellow-50 text-yellow-600', 'Modul Edukasi', 'Konten edukasi keselamatan yang dapat diakses kapan saja, mencakup prosedur penanganan berbagai jenis bencana.'],
            ['fa-code', 'bg-indigo-50 text-indigo-600', 'RESTful API', 'API lengkap yang memungkinkan integrasi dengan sistem lain dan akses data melalui berbagai platform dan perangkat.'],
            ['fa-mobile-screen', 'bg-pink-50 text-pink-600', 'Tampilan Responsif', 'Antarmuka responsif yang nyaman dipakai di ponsel maupun desktop dengan navigasi yang intuitif.'],
        ];
    @endphp

    <div class="bg-[#0B1B3D] py-16 px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Fitur Utama Sistem</h2>
        <p class="text-gray-300 text-sm max-w-2xl mx-auto">Dirancang lengkap untuk memastikan keselamatan seluruh civitas akademika kampus.</p>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-12 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($features as [$icon, $color, $title, $desc])
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-2xl {{ $color }} flex items-center justify-center mb-4">
                        <i class="fa-solid {{ $icon }} text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">{{ $title }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>

        <div class="bg-gradient-to-r from-[#0B1B3D] to-[#cc0000]/90 rounded-3xl p-8 text-white text-center">
            <h3 class="text-xl font-extrabold mb-2">Siap Memantau Keselamatan Kampus?</h3>
            <p class="text-sm text-white/80 mb-6">Buka aplikasi dan mulai pantau kondisi kampus bersama kami.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('pengguna.beranda') }}" class="bg-white text-[#cc0000] hover:bg-gray-100 font-bold py-3 px-8 rounded-xl text-sm transition-colors">Buka Dashboard</a>
                <a href="{{ route('pengguna.laporan') }}" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold py-3 px-8 rounded-xl text-sm transition-colors">Laporkan Darurat</a>
            </div>
        </div>
    </div>
@endsection
