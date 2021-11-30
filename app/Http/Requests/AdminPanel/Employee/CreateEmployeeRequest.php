<?php

namespace App\Http\Requests\AdminPanel\Employee;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateEmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|max:255|email|unique:admin_users',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ];
    }
}
