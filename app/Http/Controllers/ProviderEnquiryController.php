<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class ProviderEnquiryController extends Controller
{
    // Provider enquiry list
    public function index()
    {
        if (!auth()->user()->isProvider()) {
            abort(403);
        }

        $enquiries = Enquiry::with('listing', 'customer')
           // ->where('provider_id', auth()->id())
            ->latest()
            ->get();

        return view('provider.enquiries.index', compact('enquiries'));
    }

    // View single enquiry
    public function show(Enquiry $enquiry)
    {
        if (!auth()->user()->isProvider()) {
            abort(403);
        }

        /*if ($enquiry->provider_id !== auth()->id()) {
            abort(403);
        }*/

        $enquiry->load([
            'listing',
            'customer',
            'replies.user'
        ]);



        return view('provider.enquiries.show', compact('enquiry'));
    }

    
}
