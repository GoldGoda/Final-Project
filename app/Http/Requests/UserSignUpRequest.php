<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSignUpRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'photo'    => ['required', 'string'],
            'name'     => ['required', 'string'],
            'phone'    => ['required', 'string'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
