<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:9,15',
            'region' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'emirate' => 'required|string|max:255',
            'quantity' => 'required|integer|numeric',
            //'payment_method' => 'required|in:1,2',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'error' => true,
            'errors' => $validator->errors(),
            'code' => 400
        ], 400);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
