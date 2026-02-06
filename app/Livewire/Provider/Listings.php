<?php

namespace App\Livewire\Provider\Listings;

use Livewire\Component;
use App\Models\Listings;

class Listings extends Component
{
    public Listings $listing;

    public function mount(Listings $listing)
    {
        $this->listing = $listing;
    }

    public function render()
    {
        return view('livewire.listings.show');
    }
}
