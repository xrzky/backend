<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'user_id'=>'required',
            'fullname'=>'required',
            'phonenumber'=>'required',
            'addresslabel'=>'required',
            'city'=>'required',
            'streetbuilding'=>'required',
            'detail'=>'required',
            'isMainAddress' => 'boolean',
            'province' => 'required',
            'postalCode' => 'required'
        ];
    }
}
