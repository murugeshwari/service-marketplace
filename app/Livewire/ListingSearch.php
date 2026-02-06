<?php

namespace App\Livewire\Listings;

use Livewire\Component;
use App\Models\Listing;

class Show extends Component
{
    public Listing $listing;

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function render()
    {
        return view('livewire.listings.show');
    }
}
