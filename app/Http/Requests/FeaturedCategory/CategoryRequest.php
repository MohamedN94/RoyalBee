<?php

namespace App\Http\Requests\FeaturedCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
//            'slug' => [
//                'required',
//                Rule::unique('categories', 'slug')->ignore($this->route('categories'))
//            ],
            'title_ar' => 'nullable',
            'title_en' => 'nullable',
            'link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';

        }//end of if
        return $rules;
    }
}
