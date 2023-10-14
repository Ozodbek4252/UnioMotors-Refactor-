<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrendRequest extends FormRequest
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
            'photo' => $photo . '|image|mimes:jpeg,png,jpg,gif|max:20480',
            'name' => 'string|max:255',
        ];
    }
}
