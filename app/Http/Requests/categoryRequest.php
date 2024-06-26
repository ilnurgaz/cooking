<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Поле Имя является обязательным.",
            'slug.required' => "Поле Ярлык является обязательным.",
            'image.image' => "Файл должен быть изображением.",
            'image.mimes' => "Изображение должно быть в формате: jpeg, png, jpg.",
            'image.max' => "Максимальный размер изображения должен быть 2MB.",
        ];
    }
}
