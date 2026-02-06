<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class AdminEnquiryController extends Controller
{
    public function index()
    {
        // Extra safety – never trust routes alone
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

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
