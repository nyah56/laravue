<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name'          => 'required|string|max:255',
                'supplier_id'   => 'required|string|max:255',
                'product_image' => 'required|string|max:255',
                'price'         => 'required|integer|max:255',
                'properties'    => 'nullable|json',
            ];
        } else {
            return [
                'name'          => 'sometimes|required|string|max:255',
                'supplier_id'   => 'sometimes|required|string|max:255',
                'product_image' => 'sometimes|required|string|max:255',
                'price'         => 'sometimes|required|integer|max:255',
                'properties'    => 'nullable|json',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required'          => 'The name field is required.',
            'name.string'            => 'The name must be a string.',
            'name.max'               => 'The name may not be greater than 255 characters.',
            'supplier_id.required'   => 'The supplier ID field is required.',
            'supplier_id.string'     => 'The supplier ID must be a string.',
            'supplier_id.max'        => 'The supplier ID may not be greater than 255 characters.',
            'product_image.required' => 'The product image field is required.',
            'product_image.string'   => 'The product image must be a string.',
            'product_image.max'      => 'The product image may not be greater than 255 characters.',
            'price.required'         => 'The price field is required.',
            'price.string'           => 'The price must be a string.',
            'price.max'              => 'The price may not be greater than 255 characters.',
            'properties.json'        => 'The properties must be a valid JSON string.',
        ];
    }
}
