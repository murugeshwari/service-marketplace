<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{      
    
     public function index(Request $request)
    {
        $query = Listings::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        match ($request->sort) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $listings = $query->paginate(10)->withQueryString();

        return view('listings.index', compact('listings'));
    }

   
    public function store(Request $request)
    {
      //  dd($request);
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'category'   => 'required|string',
            'city'          => 'required|string|max:100',
            'suburb'        => 'required|string|max:100',
            'pricing_type'  => 'required|in:hourly,fixed',
            'price'         => 'required|numeric|min:0',
        ]);

        Listings::create([
            'user_id'       => Auth::id(),
            'title'         => $request->title,
            'description'   => $request->description,
            'category'   => $request->category,
            'city'          => $request->city,
            'suburb'        => $request->suburb,
            'pricing_type'  => $request->pricing_type,
            'price'         => $request->price,
            'status'        => $request->status,
        ]);
        return redirect()->route('provider.listings')
            ->with('success', 'Listing submitted for approval');
    }

    public function update(Request $request, Listing $listing)
    {

        $this->authorize('update', $listing);

        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
        ]);

        $listing->update($request->only([
            'title',
            'description',
            'price'
        ]));

        return back()->with('success', 'Listing updated');
    }

}