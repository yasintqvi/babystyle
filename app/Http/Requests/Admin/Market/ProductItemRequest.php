<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductItemRequest extends FormRequest
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
            'price' => "required|integer|min:0|max:100000000",
            'quantity' => 'required|integer|min:0|max:10000',
            'options.*.variation_id' => "nullable|exists:variations,id",
            'options.*.value' => 'nullable|max:255',
            'options.*.second_value' => 'nullable|max:255',
            'product_image' => 'nullable|image|max:4096',
        ];
    }
}
