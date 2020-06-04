<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailingListRequest extends FormRequest
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
                'email',
                'max:255',
            ]
        ];
    }
}
