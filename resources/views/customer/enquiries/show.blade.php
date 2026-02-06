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

    <h2 class="text-xl font-bold mb-4">My Enquiries</h2>

    @forelse($enquiries as $enquiry)
        <div class="border p-4 mb-6 rounded bg-white shadow">

            {{-- Listing info --}}
            <h3 class="text-lg font-semibold">
                {{ $enquiry->listing->title }}
            </h3>

            <p class="text-gray-600 mb-2">
                {{ $enquiry->listing->description }}
            </p>

            {{-- Customer original message --}}
            <div class="mt-3 p-3 bg-gray-100 rounded">
                <p class="text-sm text-gray-500">You</p>
                <p>{{ $enquiry->message }}</p>
            </div>

            {{-- Replies --}}
            @if($enquiry->replies->count())
                <div class="mt-4">
                    <h4 class="font-semibold mb-2">Replies</h4>

                    @foreach($enquiry->replies as $reply)
                        <div class="p-3 mb-2 border rounded
                            {{ $reply->user->isProvider() ? 'bg-blue-50' : 'bg-gray-50' }}">
                            
                            <p class="text-sm text-gray-500">
                                {{ $reply->user->isProvider() ? 'Provider' : 'You' }}
                            </p>

                            <p>{{ $reply->message }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 mt-3">
                    No reply from provider yet.
                </p>
            @endif

            <p class="text-sm text-gray-500 mt-3">
                Status: {{ ucfirst($enquiry->status) }}
            </p>

        </div>
    @empty
        <p>No enquiries found.</p>
    @endforelse

</div>
</div>
</body>


</html>