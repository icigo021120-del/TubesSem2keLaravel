@props(['padding' => 'p-6'])

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl shadow-sm border border-gray-100 $padding"]) }}>
    {{ $slot }}
</div>
