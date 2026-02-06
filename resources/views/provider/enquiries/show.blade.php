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
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-xl font-bold mb-2">
        {{ $enquiry->listing->title }}
    </h2>

    <p class="text-sm text-gray-600 mb-4">
        Customer: {{ $enquiry->customer->name }}
    </p>

    {{-- ORIGINAL MESSAGE --}}
    <div class="border p-3 mb-4 rounded bg-gray-50">
        <p>{{ $enquiry->message }}</p>
    </div>

    {{-- REPLIES --}}
    @foreach($enquiry->replies as $reply)
        <div class="border p-3 mb-2 rounded">
            <p class="text-sm text-gray-500">
                {{ $reply->user->name }}
            </p>
            <p>{{ $reply->message }}</p>
        </div>
    @endforeach

    {{-- REPLY FORM --}}
    <form method="POST"
          action="{{ url('/provider/enquiries/'.$enquiry->id.'/reply') }}"
          class="mt-4">
        @csrf

        <textarea name="message"
                  class="w-full border rounded p-2"
                  placeholder="Write your reply..."
                  required></textarea>

        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">
            Send Reply
        </button>
    </form>

</div>
</div>
</body>


</html>
<style>

button.mt-2.px-4.py-2.bg-blue-600.text-white.rounded {
    color: red;
}
</style>
