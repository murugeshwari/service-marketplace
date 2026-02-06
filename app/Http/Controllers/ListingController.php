<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreListingRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ListingFilterRequest;

class ListingController extends Controller
{      
    public function index(ListingFilterRequest $request)
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

            // Safe sort with fallback
            $sortOptions = [
                'price_low' => ['price', 'asc'],
                'price_high' => ['price', 'desc'],
                'newest' => ['created_at', 'desc'],
            ];

            $sort = $request->sort ?? 'newest';
            [$column, $direction] = $sortOptions[$sort] ?? ['created_at', 'desc'];
            $query->orderBy($column, $direction);

            $perPage = $request->per_page ?? 10;

            $listings = cache()->remember(
            'listings_page_' . $request->get('page', 1) . '_' . md5($request->fullUrl()),
            now()->addMinutes(2),
            fn() => $query->paginate($perPage)->withQueryString()
        );


            return view('listings.index', compact('listings'));
    }

   
    public function store(StoreListingRequest $request)
    {
        DB::transaction(function () use ($request) {
            Listings::create([
                'user_id'      => auth()->id(),
                'title'        => $request->title,
                'description'  => $request->description,
                'category'  => $request->category,
                'city'      => $request->city,
                'suburb'    => $request->suburb,
                'pricing_type' => $request->pricing_type,
                'price'        => $request->price,
                'status'       => Listings::STATUS_PENDING, // Always start as pending
            ]);
        });

        return redirect()
            ->route('provider.listings')
            ->with('success', 'Listing submitted and pending admin approval.');
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