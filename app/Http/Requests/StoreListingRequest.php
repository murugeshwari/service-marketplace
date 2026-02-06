<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->role === 'provider';
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required',
            'suburb' => 'required',
            'pricing_type' => 'required|in:hourly,fixed',
            'price' => 'required|numeric|min:0',
        ];
    }
}
