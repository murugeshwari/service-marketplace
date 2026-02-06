<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Enquiry;

class AdminEnquiryController extends Controller
{
    public function index()
    {
        // Extra safety – never trust routes alone
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

         $query = Enquiry::with([
            'listing:id,id,title,user_id',       // only load necessary fields
            'customer:id,name,email',
            'provider:id,name,email',
            'replies:id,enquiry_id,user_id,message,created_at',
                'replies.user:id,name,email'
            ]);

             // Optional filters (status, provider, customer)
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('provider_id')) {
            $query->where('provider_id', request('provider_id'));
        }

        if (request()->filled('customer_id')) {
            $query->where('customer_id', request('customer_id'));
        }

        if (request()->filled('q')) {
            $query->whereHas('listing', function ($q) {
                $q->where('title', 'like', '%' . request('q') . '%');
            });
        }

            $query->latest();
            

        $enquiries = Enquiry::with([
                'listing',
                'customer',
                'provider',
                'replies.user'
            ])
            ->latest()
            ->paginate(15);

        return view('admin.enquiries.index', compact('enquiries'));
    }
}
