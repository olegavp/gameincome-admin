<?php

namespace App\Http\Requests\AdminPanel\Product;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PlatformsRequest extends FormRequest
{
    #[ArrayShape(['name' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:30'
        ];
    }
}
