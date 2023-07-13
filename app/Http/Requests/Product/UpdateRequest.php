<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'photos' => 'array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
            'brend_id' => 'integer|max:255',
            'category_id' => 'integer|string|max:255',
            'name' => 'required|string|max:255',
            'engine' => 'nullable',
            'capacity_uz' => 'nullable',
            'capacity_ru' => 'nullable',
            'capacity_en' => 'nullable',
            'reserve' => 'nullable',
            'unit_uz' => 'nullable',
            'unit_ru' => 'nullable',
            'unit_en' => 'nullable',
            'price_uz' => 'nullable',
            'price_ru' => 'nullable',
            'price_en' => 'nullable',
            'ok' => 'nullable',
        ];
    }
}
