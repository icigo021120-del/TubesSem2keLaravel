@props(['text' => 'Belum ada data.', 'icon' => 'fa-inbox'])

<div class="text-center py-10 text-gray-400">
    <i class="fa-solid {{ $icon }} text-3xl mb-3 block"></i>
    <p class="text-sm">{{ $text }}</p>
</div>
