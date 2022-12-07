<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingChargeRequest extends FormRequest
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
    public function rules(Request $request)
    {

        return [
            'country' =>  'required',
            'zero_fiveHundred' => 'required|numeric',
            'fiveHundredOne_oneThousand' => 'required|numeric',
            'oneThousandOne_twoThousand' => 'required|numeric',
            'twoThousandOne_fiveThousand' => 'required|numeric',
            'above_FiveThousand' => 'required|numeric',
        ];
    }
}
