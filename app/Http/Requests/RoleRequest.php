<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'name'       => 'required|string|max:255',
                'guard_name' => 'required|string|max:255',

            ];
        } else {
            return [
                'name'       => 'sometimes|string|max:255',
                'guard_name' => 'sometimes|string|max:255',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required'       => 'The name field is required.',
            'name.string'         => 'The name must be a string.',
            'name.max'            => 'The name may not be greater than 255 characters.',
            'guard_name.required' => 'The guard name field is required.',
            'guard_name.string'   => 'The guard name must be a string.',
            'guard_name.max'      => 'The guard name may not be greater than 255 characters.',
        ];
    }
}
