<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add Listing</h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <input type="text" wire:model="title" placeholder="Title" class="w-full border p-2">

        <textarea wire:model="description" placeholder="Description" class="w-full border p-2"></textarea>

        <input type="text" wire:model="category" placeholder="Category" class="w-full border p-2">

        <input type="text" wire:model="city" placeholder="City" class="w-full border p-2">

        <input type="number" wire:model="price" placeholder="Price" class="w-full border p-2">

        <select wire:model="pricing_type" class="w-full border p-2">
            <option value="fixed">Fixed</option>
            <option value="hourly">Hourly</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Listing
        </button>
    </form>
</div>
