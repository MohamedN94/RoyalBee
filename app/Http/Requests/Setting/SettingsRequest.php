<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'store_name' => 'required',
            'store_description' => 'required',
            'store_description_en' => 'required',
            'whatsapp' => 'required|numeric',
            'instagram' => 'sometimes|nullable|url|max:100',
            'youtube' => 'sometimes|nullable|url|max:100',
            'facebook' => 'sometimes|nullable|url|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'whatsapp.required' => 'حقل رقم الواتساب مطلوب',
            'address.required' => 'حقل العنوان  مطلوب',
            'footer_word.required' => 'حقل الكلمة الخاصة بالفوتر  مطلوب',
            'phone.required' => 'حقل رقم الهاتف  مطلوب',
            'logo.required' => 'حقل صورة اللوجو  مطلوب',
            'map_url.required' => 'حقل صورة عنوان الشركة على الخريطة  مطلوب',
            'email.email' => 'حقل البريد الإلكتروني يجب أن يكون عنوان بريد إلكتروني صالحًا',
            'map_url.url' => 'يجب أن يكون حقل عنوان الشركة على الخريطة عنوان URL صالحًا.',
            'twitter_url.url' => 'يجب أن يكون حقل  تويتر عنوان URL صالحًا.',
            'instagram_url.url' => 'يجب أن يكون حقل  الانستجرام عنوان URL صالحًا.',
            'tictok_url.url' => 'يجب أن يكون حقل  تيك توك ان عنوان URL صالحًا.',
            'youtube_url.url' => 'يجب أن يكون حقل  اليوتيوب عنوان URL صالحًا.',
            'snapchat.url' => 'يجب أن يكون حقل  سناب شات عنوان URL صالحًا.',
        ];
    }
}
