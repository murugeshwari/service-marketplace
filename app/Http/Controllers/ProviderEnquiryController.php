<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Auth;


class ProviderEnquiryController extends Controller
{
        // Provider enquiry list
       public function index()
        {
            $user = Auth::user();
            if (!$user->isProvider()) {
                abort(403, 'Unauthorized.');
            }

            // Only fetch enquiries for this provider, paginated
            $enquiries = Enquiry::with(['listing', 'customer'])
                ->where('provider_id', $user->id)
                ->latest()
                ->paginate(15)
                ->withQueryString();

            return view('provider.enquiries.index', compact('enquiries'));
        }


         // View single enquiry
        public function show(Enquiry $enquiry)
        {
            $user = Auth::user();

            if (!$user->isProvider()) {
                abort(403, 'Unauthorized.');
            }

            if ($enquiry->provider_id !== $user->id) {
                abort(403, 'You do not have access to this enquiry.');
            }

            $enquiry->load([
                'listing:id,title,user_id',      
                'customer:id,name,email',        
                'replies:id,enquiry_id,user_id,message,created_at', 
                'replies.user:id,name,email'
            ]);

            return view('provider.enquiries.show', compact('enquiry'));
        }
            
}
