<?php

namespace App\Livewire\Provider;

use Livewire\Component;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class CreateListing extends Component
{
      public $title, $description, $category, $city, $suburb, $price, $pricing_type;


    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:10',
        'category' => 'required',
        'city' => 'required',
        'price' => 'required|numeric|min:1',
        'pricing_type' => 'required|in:hourly,fixed',
    ];

    public function save()
        {
            Listing::create([
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'city' => $this->city,
                'suburb' => $this->suburb,
                'pricing_type' => $this->pricing_type,
                'price' => $this->price,
                'status' => 'pending',
            ]);
            return redirect()->route('provider.listings');
        }


    public function render()
    {
        
        return view('livewire.provider.create-listing')
            ->layout('layouts.app');
    }


}
