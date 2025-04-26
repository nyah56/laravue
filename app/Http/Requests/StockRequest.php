<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'product_id'  => 'required|string|max:255',
                'quantity'    => 'nullable|integer|max:255',
                'description' => 'nullable|string|max:255',
            ];
        } else {
            return [
                'product_id'  => 'sometimes|string|max:255',
                'quantity'    => 'sometimes|integer|max:255',
                'description' => 'nullable|string|max:255',
            ];
        }
    }

    public function messages(): array
    {
        return [
            'product_id.required'  => 'Product ID is required',
            'product_id.string'    => 'Product ID must be a string',
            'product_id.max'       => 'Product ID must not exceed 255 characters',
            'quantity.required'    => 'Quantity is required',
            'quantity.string'      => 'Quantity must be a string',
            'quantity.max'         => 'Quantity must not exceed 255 characters',
            'description.nullable' => 'Description is optional',
        ];
    }
}
