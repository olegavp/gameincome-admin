<?php

namespace App\Http\Requests\AdminPanel\MainPage;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateCategoryRequest extends FormRequest
{
    #[ArrayShape(['category_id' => "string", 'background' => "string"])]
    public function rules(): array
    {
        return [
            'category_id' => 'bail|required|string',
            'background' => 'bail|required|file|image'
        ];
    }
}
