<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitchenRecipeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200|unique:kitchen_recipes',
            'description' => 'required|string|min:5|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите заголовок статьи',
        ];
    }

}
