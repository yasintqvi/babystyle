<?php

namespace App\Http\Requests\Market;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u|unique:discount_codes,code',
            'type' => 'required|in:0,1',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
            'amount' => 'required_if:type,=,1',
            'discount_rate' => 'required_if:type,=,0',
            'discount_ceiling' => 'required_if:type,=,0',
        ];
    }


    public function messages(){
        return [
            'discount_rate' => 'فیلد درصد الزامی است',
            'discount_ceiling' => 'فیلد حداکثر مبلغ الزامی است',
            'amount' => 'فیلد قیمت الزامی است',
        ];
    }
}
