<?php

namespace App\Http\Requests\Admin\Market;

use App\Rules\ImageExist;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:300',
            'primary_image' => 'required|image|max:4096',
            'secondary_image' => 'nullable|image|max:4096',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_active' => 'nullable|in:0,1',
            'images' => ['nullable', new ImageExist],
            'attributes.*.key' => 'nullable|max:255',
            'attributes.*.value' => 'nullable|max:255',
        ];
    }
}
