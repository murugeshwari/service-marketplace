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
<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">All Enquiries</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Listing</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Provider</th>
                    <th class="px-4 py-2 border">Message</th>
                    <th class="px-4 py-2 border">Replies</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $enquiry->id }}</td>

                        <td class="px-4 py-2 border">
                            <strong>{{ $enquiry->listing->title }}</strong><br>
                            <span class="text-sm text-gray-500">
                                {{ Str::limit($enquiry->listing->description, 60) }}
                            </span>
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $enquiry->customer->name }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $enquiry->provider->name }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ Str::limit($enquiry->message, 50) }}
                        </td>

                        <td class="px-4 py-2 border text-center">
                            {{ $enquiry->replies->count() }}
                        </td>

                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-sm
                                {{ $enquiry->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ ucfirst($enquiry->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-2 border text-sm text-gray-500">
                            {{ $enquiry->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500">
                            No enquiries found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $enquiries->links() }}
    </div>

</div>
</div>
</body>


</html>
<style>
    button.mt-3.px-4.py-2.bg-green-600.text-white.rounded {
    color: red;
}
</style>