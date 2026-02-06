<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Models\Listings;
use App\Models\Enquiry;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{   
     public function index($id)
    {
        $listing = Listings::findOrFail($id);
        return view('customer.enquiries.index', compact('listing'));
    }
    // Customer sends enquiry
   public function store(StoreEnquiryRequest $request)
    {
        // Use DB transaction for safety
        DB::transaction(function () use ($request) {

            $listing = Listings::findOrFail($request->listing_id);

            Enquiry::create([
                'listing_id'  => $listing->id,
                'customer_id' => auth()->id(),
                'provider_id' => $listing->user_id,
                'message'     => $request->message,
                'reply_message' => '',
                'status'      => 'open',
            ]);
        });
        return redirect()
            ->route('my-enquiries')
            ->with('success', 'Enquiry sent successfully.');
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
