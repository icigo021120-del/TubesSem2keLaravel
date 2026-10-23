@extends('layouts.pengguna')

@section('title', 'Edukasi - Smart Disaster System')

@section('pengguna')
    <x-page-header title="Edukasi Kebencanaan" subtitle="Pelajari langkah aman sebelum, saat, dan sesudah bencana." />

    <div class="flex gap-2 mb-6 flex-wrap">
        @foreach (['semua', 'gempa', 'kebakaran', 'banjir', 'umum'] as $k)
            <a href="{{ route('pengguna.edukasi', ['kategori' => $k]) }}"
               class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ $filter === $k ? 'bg-[#cc0000] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-red-200' }}">
                {{ ucfirst($k) }}
            </a>
        @endforeach
    </div>

    <div class="space-y-4 max-w-3xl">
        @forelse ($modules as $m)
            <x-card padding="p-0 overflow-hidden">
                <button type="button" onclick="toggleContent({{ $m->id }})" class="w-full flex items-center justify-between gap-4 p-5 text-left hover:bg-gray-50 transition-colors">
                    <div>
                        <x-badge :value="$m->kategori" class="mb-2 inline-block" />
                        <h3 class="font-bold text-gray-800 text-sm">{{ $m->judul }}</h3>
                    </div>
                    <i id="icon-{{ $m->id }}" class="fa-solid fa-chevron-down text-gray-400 transition-transform"></i>
                </button>
                <div id="konten-{{ $m->id }}" class="hidden px-5 pb-5 text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $m->konten }}</div>
            </x-card>
        @empty
            <x-card><x-empty text="Belum ada modul edukasi untuk kategori ini." icon="fa-book-open" /></x-card>
        @endforelse
    </div>
@endsection

@push('scripts')
<script>
    function toggleContent(id) {
        document.getElementById('konten-' + id).classList.toggle('hidden');
        document.getElementById('icon-' + id).classList.toggle('rotate-180');
    }
</script>
@endpush
