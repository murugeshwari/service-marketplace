<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryReplyController extends Controller
{
    public function store(Request $request, Enquiry $enquiry)
    {
        if (!auth()->user()->isProvider()) {
            abort(403);
        }


        /*if ($enquiry->provider_id !== auth()->id()) {
            abort(403);
        }*/

        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $enquiry->replies()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        $enquiry->update([
            'provider_id' => auth()->id(),
            'reply_message' => $request->message,
            'status' => 'replied',
        ]);

            
        return back()->with('success', 'Reply sent');
    }
}
