<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RecipesReguest extends FormRequest


{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|string',
            'category' => 'required',
            'time_cook' => 'required|integer|min:1',
            'number_servings' => 'required|integer|min:1',
            'ingredients' => 'required|string',
            'recipes' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Поле Имя является обязательным.",
            'image.image' => "Файл должен быть изображением.",
            'image.mimes' => "Изображение должно быть в формате: jpeg, png, jpg.",
            'image.max' => "Максимальный размер изображения должен быть 2MB.",
            'category.required' => "Поле Категория является обязательным.",
            'time_cook.required' => "Поле Время приготовления является обязательным.",
            'time_cook.integer' => "Поле Время приготовления должно быть числом.",
            'time_cook.min' => "Поле Время приготовления должно быть больше 0.",
            'number_servings.required' => "Поле Количество порций является обязательным.",
            'number_servings.integer' => "Поле Количество порций должно быть числом.",
            'number_servings.min' => "Поле Количество порций должно быть больше 0.",
            'ingredients.required' => "Поле Ингредиенты является обязательным.",
            'recipes.required' => "Поле Рецепт является обязательным.",
        ];
    }
}
