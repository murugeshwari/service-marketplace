<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:20'],
            'category' => ['required', 'string'],
            'city' => ['required', 'string'],
            'suburb' => ['required', 'string'],
            'pricing_type' => ['required', 'in:hourly,fixed'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => trim((string) $this->title),
        ]);
    }
}

