@extends('layouts.admin')

@section('title', 'Data Pengguna - Admin')

@section('admin')
    <x-page-header title="Data Pengguna" subtitle="Daftar semua akun yang terdaftar di sistem.">
        <x-slot:actions>
            <form method="GET" action="{{ route('admin.pengguna.index') }}" class="flex gap-2">
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama atau email..."
                       class="px-4 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 bg-white">
                <button type="submit" class="bg-[#cc0000] hover:bg-red-800 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </x-slot:actions>
    </x-page-header>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        @foreach (['#', 'Nama', 'Email', 'Telepon', 'Role', 'Laporan', 'Terdaftar', 'Aksi'] as $th)
                            <th class="text-left px-5 py-4 text-xs font-bold text-gray-500 uppercase">{{ $th }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($users as $u)
                        @php $self = $u->id === $adminId; @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4 text-gray-400 font-mono text-xs">#{{ $u->id }}</td>
                            <td class="px-5 py-4 font-semibold text-gray-800">
                                {{ $u->nama_lengkap }}
                                @if ($self) <span class="text-[10px] text-gray-400 font-normal">(akun aktif)</span> @endif
                            </td>
                            <td class="px-5 py-4 text-gray-600">{{ $u->email }}</td>
                            <td class="px-5 py-4 text-gray-600">{{ $u->no_telepon ?: '—' }}</td>
                            <td class="px-5 py-4"><x-badge :value="$u->role" /></td>
                            <td class="px-5 py-4 text-gray-700">{{ $u->reports_count }}</td>
                            <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">{{ $u->created_at?->format('d M Y') }}</td>
                            <td class="px-5 py-4">
                                @if ($self)
                                    <span class="text-xs text-gray-300">—</span>
                                @else
                                    <div class="flex items-center gap-4">
                                        <form method="POST" action="{{ route('admin.pengguna.role', $u) }}" class="inline"
                                              onsubmit="return confirm(@js('Ubah role ' . $u->nama_lengkap . '?'))">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs font-semibold inline-flex items-center gap-1">
                                                <i class="fa-solid fa-user-gear"></i> {{ $u->isAdmin() ? 'Jadikan Pengguna' : 'Jadikan Admin' }}
                                            </button>
                                        </form>
                                        <x-delete-button :action="route('admin.pengguna.destroy', $u)" confirm="Hapus pengguna ini beserta laporannya?" />
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8"><x-empty text="Pengguna tidak ditemukan." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
