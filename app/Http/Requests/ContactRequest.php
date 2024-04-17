<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest


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
            'name' => 'required',
            'email' => 'required|email',
           'subject' => 'required|min:5',
           'message' => 'required|min:15',

        ];
    }
    public function messages(){
        return [
            'name.required' => 'Поле имя является обязательным',
            'email.required' => 'Поле email является обязательным',
            'email.email' => 'В поле email должен быть указан действительный адрес электронной почты.',
            'subject.required' => 'Поле Тема является обязательным',
            'subject.min' => 'Поле "Тема" должно содержать не менее 5 символов',
            'message.min' => 'Поле "Сообщение" должно содержать не менее 15 символов',
            'message.required' => 'Поле Сообщение является обязательным',
        ];
    }
}