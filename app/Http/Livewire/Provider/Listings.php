<?php

namespace App\Http\Livewire\Provider;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class Listings extends Component
{
    public function render()
    {
        return view('livewire.provider.listings', [
            'listings' => Listing::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}
