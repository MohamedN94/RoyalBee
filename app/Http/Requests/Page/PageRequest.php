<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'url' => 'required|url',
            'order' => 'required|numeric',
            'description_ar' => 'required',
            'description_en' => 'required',
            'page_type_id' => 'required|exists:page_types,id',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            //

        }//end of if
        return $rules;
    }

    public function messages()
    {
        return [
            'order.required' => 'حقل الترتيب مطلوب'
        ];
    }
}
