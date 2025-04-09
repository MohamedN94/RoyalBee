<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'title_ar'   => 'required',
            'title_en'   => 'required',
            'slug'    => [
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($this->blog),
            ],
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,webp|max:2048',
        ];
    }
}
