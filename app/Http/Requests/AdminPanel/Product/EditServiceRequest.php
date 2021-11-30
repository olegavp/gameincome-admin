<?php

namespace App\Http\Requests\AdminPanel\Product;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditServiceRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'background' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|string|max:30',
            'background' => 'bail|file|image'
        ];
    }
}
