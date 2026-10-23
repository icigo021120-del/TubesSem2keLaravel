@if (session('success'))
    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
        <p class="font-semibold flex items-center gap-2 mb-1"><i class="fa-solid fa-circle-exclamation"></i> Periksa kembali isian kamu:</p>
        <ul class="list-disc list-inside text-xs space-y-0.5">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
