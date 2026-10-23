@props(['val', 'label', 'icon', 'color' => 'bg-blue-50 text-blue-600'])

<div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col gap-2">
    <div class="w-9 h-9 rounded-xl {{ $color }} flex items-center justify-center">
        <i class="fa-solid {{ $icon }} text-sm"></i>
    </div>
    <p class="text-2xl font-extrabold text-gray-900">{{ $val }}</p>
    <p class="text-[10px] font-semibold text-gray-500 uppercase">{{ $label }}</p>
</div>
