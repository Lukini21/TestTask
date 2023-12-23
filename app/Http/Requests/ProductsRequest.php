<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bathrooms' => 'array',
            'bathrooms.*' => 'integer',
            'bedrooms' => 'array',
            'bedrooms.*' => 'integer',
            'garages' => 'array',
            'garages.*' => 'integer',
            'storeys' => 'array',
            'storeys.*' => 'integer',
            'name' => 'string|max:15|nullable',
            'price_max' => 'numeric',
            'price_min' => 'numeric'
        ];
    }
}
