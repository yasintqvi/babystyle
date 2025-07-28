<?php

namespace App\Http\Requests\Market;

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
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|min:1|max:300',
            'postal_code' => ['nullable'],
            'plaque' => 'nullable',
            'unit' => 'nullable',
            'receiver_full_name' => 'nullable',
            'receiver_phone_number' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'unit' => 'واحد',
            'plaque' => 'پلاک',
            'receiver_phone_number' => 'موبایل گیرنده',
            'receiver_full_name' => 'نام گیرنده',
        ];
    }
}

