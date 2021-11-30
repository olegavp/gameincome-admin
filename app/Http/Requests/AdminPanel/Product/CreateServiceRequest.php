<?php

namespace App\Http\Requests\AdminPanel\Product;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateServiceRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'background' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:30',
            'background' => 'bail|required|file|image'
        ];
    }
}
