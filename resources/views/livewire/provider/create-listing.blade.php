
   <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">

                {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Create New Listing</h1>
            <p class="text-blue-100 text-sm mt-1">Fill in the details below to publish your service</p>
            </div>
            @if ($errors->any())
                <div style="color:red; margin-bottom:10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{ route('listings.store') }}" class="p-8 space-y-6" method="POST">
                    @csrf
                    {{-- Title --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                        <input type="text" name="title" id="title" placeholder="Listing title" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" placeholder="Describe your item" 
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                        <select name="category" id="category" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home</option>
                        </select>
                    </div>

                    {{-- City --}}
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 font-medium mb-2">City</label>
                        <input type="text" name="city" id="city" placeholder="Enter city" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    {{-- Suburb --}}
                    <div class="mb-4">
                        <label for="suburb" class="block text-gray-700 font-medium mb-2">Suburb</label>
                        <input type="text" name="suburb" id="suburb" placeholder="Enter suburb" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                        <input type="number" name="price" id="price" placeholder="0.00" step="0.01" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    {{-- Pricing Type --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Pricing Type</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="pricing_type" value="fixed" checked 
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" />
                                Fixed
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="pricing_type" value="hourly" 
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" />
                                Hourly
                            </label>
                        </div>
                    </div>

                    {{-- Status --}}
                     <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                        <select name="status" id="status" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="text-right">
                        <button type="submit" 
                                class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                            Save Listing
                        </button>
                    </div>
                </form>
            </div>

        @livewireScripts
    </div>

