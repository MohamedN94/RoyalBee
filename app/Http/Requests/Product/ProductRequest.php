<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',

            'type' => 'required|in:simple,attribute',
            'attribute.name' => 'required_if:type,attribute|string|max:255',
            'attribute.values' => 'required_if:type,attribute|array|min:1',
            'attribute.values.*.value' => 'required_if:type,attribute|string|max:255',
            'attribute.values.*.price' => 'required_if:type,attribute|numeric|min:0',
        
            'description_ar' => 'required',
            'description_en' => 'required',
            'short_desc_ar' => 'required',
            'short_desc_en' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required_if:type,simple|numeric',
            'discount_price' => 'nullable|numeric|lt:price',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video' => 'nullable|url',
            // 'meta_title_ar' => 'required',
            // 'meta_title_en' => 'required',
            // 'meta_description_ar' => 'required',
            // 'meta_description_en' => 'required',
            // 'alt_image' => 'required',
            'sku' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\-]+$/', // Alphanumeric and can include hyphens
                Rule::unique('products', 'sku')->ignore($this->product), // Ignore current product on edit
            ],
            'sale_start_date' => 'nullable|date',
            'sale_end_date' => 'nullable|date',
            'tax_rate' => 'nullable|decimal:0,10000',
            'stock' => 'nullable|integer',
            //'photo' => 'required',
            'photo.*' => 'required|image|mimes:png,jpeg,jpg,webp',

        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            // $rules['photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048';

        }//end of if
        return $rules;
    }
}
