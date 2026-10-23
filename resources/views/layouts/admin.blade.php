@extends('layouts.app')

@section('body-class', 'bg-[#F4F7FB] font-sans flex h-screen overflow-hidden text-gray-800')

@section('content')
    <x-admin.sidebar />

    <main class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <x-flash />
        @yield('admin')
    </main>
@endsection
