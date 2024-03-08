<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Whoops\Run;

class StoreProductRequest extends FormRequest
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
            'name' =>['required', Rule::unique('products')->ignore($this->product)],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'storage' => ['required'],
            'image' => ['required','url'],
            'image2' => ['nullable','url'],
            'image3' => ['nullable','url'],
            'image4' => ['nullable','url'],
            'description' => ['nullable'],
        ];
    }
}
