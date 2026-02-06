<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Listings;
use Illuminate\Http\Request;

class CustomerReplyController extends Controller
{
   public function store(Request $request, Enquiry $enquiry)
    {
        if (!auth()->user()->isCustomer()) {
            abort(403);
        }

        if ($enquiry->customer_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $enquiry->replies()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return back();
    }

}
