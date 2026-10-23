@props(['name', 'label' => null, 'value' => null, 'rows' => 4, 'required' => false])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wide">
            {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" @required($required)
              {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-red-200 ' . ($errors->has($name) ? 'border-red-400' : 'border-gray-200')]) }}>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
