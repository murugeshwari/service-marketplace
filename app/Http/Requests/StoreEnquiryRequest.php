<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only customers can send enquiries
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'listing_id' => ['required', 'exists:listings,id'],
            'message' => ['required', 'string', 'min:10'],
        ];
    }
}
