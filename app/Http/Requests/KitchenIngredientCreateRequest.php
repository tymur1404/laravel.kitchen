<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KitchenIngredientCreateRequest extends FormRequest
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
    //правила для валидации
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200|unique:kitchen_recipes',
        ];
    }
}
