<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Disaster System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .custom-scrollbar::-webkit-scrollbar{width:6px}
        .custom-scrollbar::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:20px}
    </style>
    @stack('styles')
</head>
<body class="@yield('body-class', 'bg-[#F4F7FB] font-sans text-gray-800')">

    @yield('content')

    @stack('scripts')
</body>
</html>
