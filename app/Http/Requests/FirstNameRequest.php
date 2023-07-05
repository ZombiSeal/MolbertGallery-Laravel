<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirstNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'firstName' => 'required|regex:/^([A-Za-zА-Яа-я-]{2,})$/u'
        ];
    }

    public  function  messages():array
    {
        return [
            'firstName.required' => 'Заполните поле',
            'firstName.regex' => 'Содержатся цифры или недостаочная длина'
        ];
    }
}
