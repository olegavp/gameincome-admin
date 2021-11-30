<?php

namespace App\Http\Requests\AdminPanel\News;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'bail|string|max:110',
            'description_on_3_words' => 'bail|string|max:50',
            'small_description' => 'bail|string|max:255',
            'description' => 'bail|string',
            'relation' => 'bail',
            'new_relation' => 'bail',
            'small_background' => 'bail|file|image',
            'background' => 'bail|file|image'
        ];
    }
}
