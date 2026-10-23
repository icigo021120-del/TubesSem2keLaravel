@extends('layouts.pengguna')

@section('title', 'Dashboard - Smart Disaster System')

@section('pengguna')
    <div class="mb-8">
        <h2 class="text-xl text-gray-600 font-medium mb-1">
            Selamat Datang, <span class="font-bold text-gray-800">{{ $user?->nama_lengkap ?? 'Pengguna' }}!</span>
        </h2>
        <p class="text-sm text-gray-500">Sistem pemantauan dan koordinasi bencana terpadu untuk lingkungan Telkom University.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <a href="{{ route('pengguna.status') }}" class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-green-300 transition-all">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0"><i class="fa-solid fa-check text-xl"></i></div>
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-0.5">Status Sistem</p>
                <p class="text-sm font-bold text-green-600">Sistem Aktif & Terpantau</p>
            </div>
        </a>

        <a href="{{ route('pengguna.pantauan') }}" class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-300 transition-all">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 shrink-0"><i class="fa-solid fa-satellite-dish text-xl"></i></div>
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-0.5">Sensor Aktif</p>
                <p class="text-sm font-bold text-blue-600">{{ $sensorAktif }} Sensor Online</p>
            </div>
        </a>

        <a href="{{ route('pengguna.peringatan') }}" class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-orange-300 transition-all">
            <div class="w-12 h-12 rounded-full {{ $peringatanAktif > 0 ? 'bg-orange-100 text-orange-500' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center shrink-0">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-0.5">Peringatan Aktif</p>
                <p class="text-sm font-bold {{ $peringatanAktif > 0 ? 'text-orange-500' : 'text-gray-600' }}">{{ $peringatanAktif }} Peringatan Aktif</p>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-5 flex justify-between items-center border-b border-gray-50">
                <div>
                    <h3 class="font-bold text-gray-800">Peta Risiko Kawasan Kampus</h3>
                    <p class="text-xs text-gray-500">Live feed dari stasiun pemantauan Telkom University</p>
                </div>
                <a href="{{ route('pengguna.peta') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fa-solid fa-expand"></i> Buka Peta Penuh
                </a>
            </div>
            <div class="flex-1 bg-gray-900 relative min-h-[300px]">
                <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1000&auto=format&fit=crop"
                     alt="Map View" class="w-full h-full object-cover opacity-80 mix-blend-luminosity absolute inset-0">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                    <div class="bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded-md mb-1 shadow-lg">Gedung Aman</div>
                    <i class="fa-solid fa-location-dot text-green-500 text-2xl drop-shadow-md"></i>
                </div>
                <div class="absolute top-4 left-6 flex flex-col items-center">
                    <div class="bg-yellow-400 text-[9px] font-bold px-1.5 py-0.5 rounded text-gray-900 mb-0.5">TULT</div>
                    <i class="fa-solid fa-circle-dot text-yellow-400 text-sm"></i>
                </div>
                <div class="absolute bottom-8 right-10 flex flex-col items-center">
                    <div class="bg-blue-400 text-[9px] font-bold px-1.5 py-0.5 rounded text-white mb-0.5">FIT</div>
                    <i class="fa-solid fa-circle-dot text-blue-400 text-sm"></i>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-5">
            <x-card padding="p-5">
                <h3 class="font-bold text-gray-800 mb-4 text-sm">Akses Cepat</h3>
                <div class="grid grid-cols-2 gap-3">
                    @php
                        $quick = [
                            ['pengguna.rute',    'fa-solid fa-route',        'Rute Evakuasi',   'hover:border-red-300 hover:bg-red-50',       'bg-red-50 text-[#cc0000]'],
                            ['pengguna.titik',   'fa-solid fa-users',        'Titik Kumpul',    'hover:border-green-300 hover:bg-green-50',   'bg-green-50 text-green-600'],
                            ['pengguna.laporan', 'fa-regular fa-file-lines', 'Laporan Keadaan', 'hover:border-blue-300 hover:bg-blue-50',     'bg-blue-50 text-blue-600'],
                            ['pengguna.edukasi', 'fa-solid fa-book-open',    'Edukasi',         'hover:border-orange-300 hover:bg-orange-50', 'bg-orange-50 text-orange-500'],
                        ];
                    @endphp
                    @foreach ($quick as [$r, $ic, $label, $hover, $iconTone])
                        <a href="{{ route($r) }}" class="border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center gap-2 transition-colors {{ $hover }}">
                            <div class="w-10 h-10 {{ $iconTone }} rounded-lg flex items-center justify-center"><i class="{{ $ic }}"></i></div>
                            <span class="text-xs font-semibold text-gray-700 text-center">{{ $label }}</span>
                        </a>
                    @endforeach
                </div>
            </x-card>

            <div class="bg-red-50 p-6 rounded-2xl border border-red-200 text-center flex-1 flex flex-col justify-center">
                <i class="fa-solid fa-location-dot text-[#cc0000] text-3xl mb-3"></i>
                <h3 class="font-bold text-[#cc0000] mb-1">Butuh Bantuan Segera?</h3>
                <p class="text-xs text-red-800 mb-4 px-2">Laporkan keadaan darurat sekarang untuk respon tim cepat.</p>
                <a href="{{ route('pengguna.laporan') }}" class="w-full bg-[#cc0000] hover:bg-red-800 text-white font-bold py-3 px-4 rounded-xl text-sm transition-colors shadow-lg shadow-red-500/30">
                    LAPORKAN DARURAT
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-card>
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800 text-sm">Aktivitas Terbaru</h3>
                <a href="{{ route('pengguna.notifikasi') }}" class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-5">
                @forelse ($aktivitas as $akt)
                    @php
                        $dot = match ($akt->tingkat_bahaya) {
                            'awas' => 'bg-red-500', 'siaga' => 'bg-orange-500', 'waspada' => 'bg-yellow-500', default => 'bg-blue-500',
                        };
                    @endphp
                    <div class="flex items-start gap-4">
                        <div class="w-3 h-3 mt-1.5 rounded-full {{ $dot }} shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $akt->pesan_peringatan }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $akt->waktu_kejadian->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <x-empty text="Belum ada aktivitas terbaru." icon="fa-clock" />
                @endforelse
            </div>
        </x-card>

        <a href="{{ route('pengguna.status') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors">
            <h3 class="font-bold text-gray-800 text-sm mb-6 self-start w-full text-left">Indeks Keamanan Kampus</h3>
            <div class="relative w-40 h-40 mb-6">
                <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                    <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                    <path class="text-[#00875A]" stroke-dasharray="{{ $indeks }}, 100" stroke-width="3" stroke-linecap="round"
                          stroke="currentColor" fill="none"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ $indeks }}%</span>
                    <span class="text-[10px] font-bold text-[#00875A] tracking-wide">SANGAT AMAN</span>
                </div>
            </div>
            <p class="text-xs text-gray-500 max-w-[250px] leading-relaxed">
                Berdasarkan data cuaca, aktivitas seismik, dan kesiapan tim tanggap bencana saat ini.
            </p>
        </a>
    </div>
@endsection
