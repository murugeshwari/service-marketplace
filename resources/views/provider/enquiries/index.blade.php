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

<div class="max-w-5xl mx-auto p-6">

    <h2 class="text-xl font-bold mb-4">Incoming Enquiries</h2>

    @forelse($enquiries as $enquiry)
        <a href="{{ url('/provider/enquiries/'.$enquiry->id) }}"
           class="block border p-4 mb-3 rounded bg-white shadow hover:bg-gray-50">

            <p class="font-semibold">{{ $enquiry->listing->title }}</p>
            <p class="text-sm text-gray-600">
                From: {{ $enquiry->customer->name }}
            </p>
            <p class="text-sm">
                Status: {{ ucfirst($enquiry->status) }}
            </p>
        </a>
    @empty
        <p>No enquiries.</p>
    @endforelse

</div>
</div>
</body>


</html>
<style>
    button.mt-3.px-4.py-2.bg-green-600.text-white.rounded {
    color: red;
}
</style>