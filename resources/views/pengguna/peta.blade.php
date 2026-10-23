@extends('layouts.pengguna')

@section('title', 'Peta Risiko - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Peta Risiko Real-time" subtitle="Visualisasi zona risiko bencana di kawasan Telkom University." />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-sm">Peta Kawasan Kampus</h3>
                <div class="flex gap-3 text-[10px] font-semibold">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Aman</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 bg-yellow-400 rounded-full inline-block"></span> Waspada</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span> Bahaya</span>
                </div>
            </div>
            <div class="relative h-96 bg-gray-900">
                <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1200&auto=format&fit=crop"
                     alt="Peta Kampus" class="w-full h-full object-cover opacity-70 mix-blend-luminosity">
                @php
                    // posisi penanda ilustrasi di atas gambar peta
                    $spots = [['top-[35%] left-[40%]', 'text-yellow-400'], ['top-[55%] left-[60%]', 'text-orange-400'], ['top-[25%] left-[55%]', 'text-green-400'], ['top-[65%] left-[30%]', 'text-green-400']];
                @endphp
                @foreach ($sensors->take(4) as $i => $s)
                    @php $color = $s->status === 'aktif' ? 'text-green-400' : ($s->status === 'rusak' ? 'text-red-500' : 'text-yellow-400'); @endphp
                    <div class="absolute {{ $spots[$i][0] }} flex flex-col items-center cursor-pointer group">
                        <div class="bg-white rounded-lg shadow-lg px-2 py-1 text-[10px] font-bold mb-1 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                            {{ $s->lokasi_gedung }} - {{ ucfirst($s->status) }}
                        </div>
                        <i class="fa-solid fa-location-dot {{ $color }} text-2xl drop-shadow-lg"></i>
                    </div>
                @endforeach
                <div class="absolute bottom-4 right-4 bg-black/60 text-white text-[10px] px-3 py-2 rounded-lg backdrop-blur-sm">
                    <p class="font-bold">Telkom University</p>
                    <p class="text-gray-300">Bandung, Jawa Barat</p>
                </div>
            </div>
        </div>

        <x-card>
            <h3 class="font-bold text-gray-800 mb-4 text-sm">Status Zona</h3>
            <div class="space-y-3">
                @forelse ($sensors as $s)
                    @php
                        $c = match ($s->status) {
                            'aktif'       => ['bg-green-500', 'bg-green-50'],
                            'rusak'       => ['bg-red-500', 'bg-red-50'],
                            'maintenance' => ['bg-yellow-400', 'bg-yellow-50'],
                            default       => ['bg-gray-400', 'bg-gray-50'],
                        };
                    @endphp
                    <div class="flex items-center gap-3 p-3 {{ $c[1] }} rounded-xl border border-gray-100">
                        <div class="w-2.5 h-2.5 rounded-full {{ $c[0] }} shrink-0 animate-pulse"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-bold text-gray-800 truncate">{{ $s->lokasi_gedung }}</p>
                            <p class="text-[10px] text-gray-500">{{ $s->jenis_sensor }} — {{ ucfirst($s->status) }}</p>
                        </div>
                    </div>
                @empty
                    <x-empty text="Belum ada sensor." />
                @endforelse
            </div>
            <div class="mt-5 pt-4 border-t border-gray-100">
                <p class="text-[10px] text-gray-400 text-center">Data diperbarui secara berkala. Terakhir: {{ now()->format('H:i') }} WIB</p>
            </div>
        </x-card>
    </div>
@endsection
