@props(['title', 'subtitle' => null])

<div class="flex justify-between items-center mb-7 flex-wrap gap-3">
    <div>
        <h2 class="text-xl font-bold text-gray-900">{{ $title }}</h2>
        @if ($subtitle)
            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="flex items-center gap-2">{{ $actions }}</div>
    @endisset
</div>
