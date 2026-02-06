<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marketplace</title>

     {{-- Livewire styles --}}
    @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
 <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
                @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

    <div style="padding:20px;">
        @yield('content')
    </div>
 {{ $slot }}
    {{-- Livewire scripts --}}
    @livewireScripts
</div>
</body>


</html>
<style>
    button.bg-indigo-600.text-white.px-6.py-2.rounded-md.hover\:bg-indigo-700.transition {
    color: red;
}
</style>