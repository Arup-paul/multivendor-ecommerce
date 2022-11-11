<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'product_name' => 'required',
                'product_color' => 'required',
                'product_price' => 'required|numeric',
                'product_discount' => 'required|numeric',
                'product_code' => 'required',
                'product_weight' => 'required|numeric',
                'product_image' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'The Brand Field Is Required',
            'category_id.required' => 'The Category Field Is Required'
        ];
    }
}
