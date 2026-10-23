@props(['action', 'confirm' => 'Yakin ingin menghapus data ini?', 'label' => 'Hapus'])

<form method="POST" action="{{ $action }}" onsubmit="return confirm(@js($confirm))" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" {{ $attributes->merge(['class' => 'text-red-500 hover:text-red-700 text-xs font-semibold inline-flex items-center gap-1']) }}>
        <i class="fa-solid fa-trash"></i> {{ $label }}
    </button>
</form>
