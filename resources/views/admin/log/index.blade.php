@extends('layouts.admin')

@section('title', 'Log Aktivitas - Admin')

@section('admin')
    <x-page-header title="Log Aktivitas" subtitle="Riwayat peringatan sensor, laporan, dan aktivitas admin." />

    <div class="flex gap-2 mb-6 flex-wrap">
        @foreach (['semua' => 'Semua', 'alert' => 'Peringatan', 'laporan' => 'Laporan', 'aktivitas' => 'Aktivitas'] as $key => $label)
            <a href="{{ route('admin.log', ['tipe' => $key]) }}"
               class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ $filter === $key ? 'bg-[#cc0000] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-red-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <x-card>
        @forelse ($logs as $log)
            @php
                [$icon, $iconColor] = match ($log['tipe']) {
                    'alert'   => ['fa-bell', 'bg-red-50 text-red-600'],
                    'laporan' => ['fa-file-lines', 'bg-purple-50 text-purple-600'],
                    default   => ['fa-clock-rotate-left', 'bg-blue-50 text-blue-600'],
                };
            @endphp
            <div class="flex items-start gap-4 py-4 {{ ! $loop->last ? 'border-b border-gray-50' : '' }}">
                <div class="w-10 h-10 rounded-xl {{ $iconColor }} flex items-center justify-center shrink-0">
                    <i class="fa-solid {{ $icon }} text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <x-badge :value="$log['sub']" />
                        @if ($log['nama_user'])
                            <span class="text-xs text-gray-500">oleh {{ $log['nama_user'] }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-800">{{ \Illuminate\Support\Str::limit($log['teks'], 140) }}</p>
                    @if ($log['lokasi'])
                        <p class="text-xs text-gray-500 mt-0.5"><i class="fa-solid fa-location-dot mr-1 text-red-400"></i>{{ $log['lokasi'] }}</p>
                    @endif
                </div>
                <p class="text-[11px] text-gray-400 whitespace-nowrap">{{ $log['waktu']->format('d M Y, H:i') }}</p>
            </div>
        @empty
            <x-empty text="Belum ada aktivitas." />
        @endforelse

        <div class="mt-6">{{ $logs->links() }}</div>
    </x-card>
@endsection
