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
    <h1>My Listings</h1>
    
<form method="GET" action="{{ url('provider/listings') }}"
      class="mb-6 grid grid-cols-1 md:grid-cols-6 gap-4">

    <input type="text"
           name="q"
           value="{{ request('q') }}"
           placeholder="Search keyword..."
           class="border rounded px-3 py-2 col-span-2">

    <input type="text"
           name="city"
           value="{{ request('city') }}"
           placeholder="City"
           class="border rounded px-3 py-2">

    <select name="category" class="border rounded px-3 py-2">
        <option value="">All Categories</option>
        <option value="electronics" @selected(request('category')=='electronics')>Electronics</option>
        <option value="fashion" @selected(request('category')=='fashion')>Fashion</option>
        <option value="home" @selected(request('category')=='home')>Home</option>
    </select>

    <input type="number"
           name="min_price"
           value="{{ request('min_price') }}"
           placeholder="Min ₹"
           class="border rounded px-3 py-2">

    <input type="number"
           name="max_price"
           value="{{ request('max_price') }}"
           placeholder="Max ₹"
           class="border rounded px-3 py-2">

    <select name="sort" class="border rounded px-3 py-2">
        <option value="">Sort</option>
        <option value="newest" @selected(request('sort')=='newest')>Newest</option>
        <option value="price_low" @selected(request('sort')=='price_low')>Price: Low → High</option>
        <option value="price_high" @selected(request('sort')=='price_high')>Price: High → Low</option>
    </select>

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded col-span-1 md:col-span-6">
        Apply Filters
    </button>
</form>

 <div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Category</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">City</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Suburb</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Price</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Pricing Type</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @forelse ($listings as $listing)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-600">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->title }}
                    </td>

                    <td class="px-4 py-2 text-sm text-gray-600">
                        {{ Str::limit($listing->description, 80) }}
                    </td>
                     <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->category }}
                    </td>
                     <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->city }}
                    </td>
                     <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->suburb }}
                    </td>
                     <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->price }}
                    </td>
                     <td class="px-4 py-2 font-medium text-gray-800">
                        {{ $listing->pricing_type }}
                    </td>


                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded
                            {{ $listing->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($listing->status) }}
                        </span>
                    </td>

                    <td class="px-4 py-2">
                    <a href="{{ url('/listings/'.$listing->id) }}">
                            Send Enquiry
                        </a>
                    </td>
                  
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        No listings found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
</body>


</html>