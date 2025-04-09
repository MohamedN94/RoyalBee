<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => 'required|string' ,
            'name_en' => 'required|string' ,
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'description_ar' => 'required' ,
            'description_en' => 'required' ,
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048' ,
        ];
    }
}
