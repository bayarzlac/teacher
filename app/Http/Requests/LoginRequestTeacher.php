<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestTeacher extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|exists:teachers',
            'password' => 'required'
        ];
    }
}
