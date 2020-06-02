<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users',
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ];
    }
}
