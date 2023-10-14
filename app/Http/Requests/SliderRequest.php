<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $photo = 'nullable';
        } else {
            $photo = 'required';
        }

        return [
            'photo' => $photo . '|mimes:jpeg,png,jpg,gif,mp4,avi,mov,wmv|max:20480',
            'link' => 'string|url|max:255',
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'discription_uz' => 'nullable',
            'discription_ru' => 'nullable',
            'discription_en' => 'nullable',
        ];
    }
}
