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
<form method="POST" action="{{ url('/enquiriessubmit') }}">
    @csrf

    {{-- REQUIRED: listing_id --}}
    <input type="hidden"
           name="listing_id"
           value="{{ $listing->id }}">

    {{-- REQUIRED: message --}}
    <div class="mt-4">
        <label class="block font-semibold mb-1">
            Your Message
        </label>

        <textarea name="message"
                  rows="4"
                  minlength="10"
                  required
                  class="w-full border rounded p-2"
                  placeholder="Write at least 10 characters...">{{ old('message') }}</textarea>

        @error('message')
            <p class="text-red-600 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <button type="submit"
            class="mt-3 px-4 py-2 bg-green-600 text-white rounded">
        Send Enquiry
    </button>
</form>
</div>
</body>


</html>
<style>
    button.mt-3.px-4.py-2.bg-green-600.text-white.rounded {
    color: red;
}
</style>