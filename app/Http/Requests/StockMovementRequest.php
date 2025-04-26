<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockMovementRequest extends FormRequest
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
                'product_id'        => 'required|max:255',
                'date'              => 'required|date',
                'type'              => 'required|in:in,out',
                'quantity'          => 'required|numeric|min:1',
                'reason'            => 'required|max:255',
                'manifest_hardcopy' => 'nullable|file|mimes:pdf|between:100,500',
                'meta'              => 'nullable|json',
            ];
        } else {
            return [
                'product_id'        => 'sometimes',
                'date'              => 'sometimes|required|date',
                'type'              => 'sometimes|required|in:in,out',
                'quantity'          => 'sometimes|required|numeric|min:1',
                'reason'            => 'sometimes|required|max:255',
                'manifest_hardcopy' => 'sometimes|file|mimes:pdf|between:100,500',
                'meta'              => 'sometimes|json',
            ];
        }
    }
    public function messages(): array
    {
        return [
            'product_id.required'       => 'A product must be selected',
            // 'product_id.exists'         => 'The selected product is invalid',
            'date.required'             => 'Date is required',
            'date.date'                 => 'Please enter a valid date',
            'type.required'             => 'Movement type is required',
            'type.in'                   => 'Movement type must be either in or out',
            'quantity.required'         => 'Quantity is required',
            'quantity.numeric'          => 'Quantity must be a number',
            'quantity.min'              => 'Quantity must be at least 1',
            'reason.required'           => 'Reason is required',
            'reason.max'                => 'Reason cannot exceed 255 characters',
            'manifest_hardcopy.file'    => 'Manifest must be a file',
            'manifest_hardcopy.mimes'   => 'Manifest must be a PDF file',
            'manifest_hardcopy.between' => 'Manifest file size must be between 100KB and 500KB',
            'meta.json'                 => 'Meta data must be in valid JSON format',
        ];
    }
}
