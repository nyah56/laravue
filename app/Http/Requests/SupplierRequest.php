<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                'name'         => 'required|string|max:255',
                'company_logo' => 'required|string|max:255',
                'address'      => 'required|string|max:255',
                'contacts'     => 'json',
            ];

        } else {
            return [

                'name'         => 'sometimes|string|max:255',
                'company_logo' => 'sometimes|string|max:255',
                'address'      => 'sometimes|string|max:255',
                'contacts'     => 'json',

            ];
        }
    }
    public function messages()
    {
        return [
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name must be a string.',
            'name.max'              => 'The name may not be greater than 255 characters.',
            'company_logo.required' => 'The supplier ID field is required.',
            'company_logo.string'   => 'The supplier ID must be a string.',
            'company_logo.max'      => 'The supplier ID may not be greater than 255 characters.',
            'address.required'      => 'The address field is required.',
            'address.string'        => 'The address must be a string.',
            'address.max'           => 'The price may not be greater than 255 characters.',
            'contacts.json'         => 'The contacts must be a valid JSON string.',
        ];
    }
}
