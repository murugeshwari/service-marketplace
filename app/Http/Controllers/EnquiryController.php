<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Listings;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{   

     public function index($id)
    {
        $listing = Listings::findOrFail($id);
        return view('customer.enquiries.index', compact('listing'));
    }
    // Customer sends enquiry
    public function store(Request $request)
    {
        if (!auth()->user()->isCustomer()) {
            abort(403);
        }



        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'message' => 'required|string|min:10',
        ]);

        $listing = Listings::findOrFail($request->listing_id);
       
        // Prevent provider messaging himself
        /*if ($listing->user_id === auth()->id()) {
            abort(403);
        }*/

        Enquiry::create([
            'listing_id'  => $listing->id,
            'customer_id' => auth()->id(),
            'provider_id' => $listing->user_id,
            'message'     => $request->message,
            'reply_message'     =>"",
            'status'      => 'open',
        ]);

       // return back()->with('success', 'Enquiry sent');

         return redirect()->route('my-enquiries')
    ->with('success', 'Enquiry sent');

    }

    // Customer enquiry list

    public function customerIndex()
    {
        if (!auth()->user()->isCustomer()) {
            abort(403);
        }

        $enquiries = Enquiry::with([
                'listing',
                'replies.user',  
                'provider'
            ])
            ->where('customer_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.enquiries.show', compact('enquiries'));
    }


    /*public function customerIndex()
    {
        if (!auth()->user()->isCustomer()) {
            abort(403);
        }

        $enquiries = Enquiry::with('listing')
            ->where('customer_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.enquiries.show', compact('enquiries'));
    }*/
}
