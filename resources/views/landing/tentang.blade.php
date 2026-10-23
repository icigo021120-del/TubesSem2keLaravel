@extends('layouts.landing')

@section('title', 'Tentang - Smart Disaster System')

@section('landing')
    @php
        $team = [
            ['M', 'Mahasiswa Pengembang', 'Full-Stack Developer', 'bg-red-500'],
            ['D', 'Dosen Pembimbing', 'Web Programming Supervisor', 'bg-blue-600'],
            ['T', 'Tim Kampus', 'Safety & Disaster Management', 'bg-green-600'],
        ];
        $techs = [
            ['fa-brands fa-laravel', 'Laravel', 'text-red-600 bg-red-50'],
            ['fa-solid fa-database', 'MySQL Database', 'text-blue-600 bg-blue-50'],
            ['fa-brands fa-react', 'React JS Frontend', 'text-cyan-600 bg-cyan-50'],
            ['fa-solid fa-code', 'RESTful API', 'text-green-600 bg-green-50'],
            ['fa-brands fa-css3-alt', 'Tailwind CSS', 'text-teal-600 bg-teal-50'],
            ['fa-solid fa-puzzle-piece', 'Blade Components', 'text-orange-600 bg-orange-50'],
            ['fa-solid fa-layer-group', 'Layout App', 'text-purple-600 bg-purple-50'],
            ['fa-solid fa-mobile-screen', 'Responsive Mobile', 'text-pink-600 bg-pink-50'],
        ];
    @endphp

    <div class="bg-[#0B1B3D] py-16 px-6 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Tentang Smart Disaster System</h2>
        <p class="text-gray-300 text-sm max-w-2xl mx-auto">Platform manajemen bencana terpadu berbasis web yang dirancang untuk meningkatkan keselamatan seluruh civitas akademika.</p>
    </div>

    <div class="max-w-5xl mx-auto px-6 py-12 space-y-10 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Latar Belakang</h3>
                <p class="text-sm text-gray-600 leading-relaxed mb-3">
                    Telkom University merupakan salah satu kampus dengan jumlah civitas akademika terbesar di Indonesia. Keselamatan seluruh warga kampus menjadi prioritas utama, terutama dalam menghadapi potensi bencana seperti gempa bumi, kebakaran, dan banjir.
                </p>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Smart Disaster System hadir sebagai solusi teknologi untuk mempercepat respons tanggap darurat dan mempermudah koordinasi antara pengguna dan tim petugas di seluruh area kampus.
                </p>
            </div>
            <div class="bg-gradient-to-br from-[#0B1B3D] to-[#cc0000]/80 rounded-3xl p-8 text-white text-center">
                <i class="fa-solid fa-shield-halved text-5xl mb-4 text-white/90"></i>
                <h4 class="font-bold text-lg">Visi</h4>
                <p class="text-sm text-white/80 mt-2">Kampus yang aman, siap siaga, dan tangguh dalam menghadapi bencana dengan dukungan teknologi informasi modern.</p>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Tim Pengembang</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach ($team as [$initial, $name, $role, $color])
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 text-center">
                        <div class="w-14 h-14 rounded-full {{ $color }} text-white text-xl font-bold flex items-center justify-center mx-auto mb-3">{{ $initial }}</div>
                        <p class="font-bold text-gray-800 text-sm">{{ $name }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $role }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <x-card>
            <h3 class="font-bold text-gray-800 mb-5 text-sm">Teknologi yang Digunakan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($techs as [$icon, $label, $color])
                    <div class="flex items-center gap-3 p-3 {{ $color }} rounded-xl">
                        <i class="{{ $icon }} w-5 text-center"></i>
                        <span class="text-xs font-semibold">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </x-card>
    </div>
@endsection
