<?php

namespace App\Http\Requests\AdminPanel\MainPage;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateInsertRequest extends FormRequest
{
    #[ArrayShape(['over_insert' => "string", 'small_description' => "string", 'description' => "string", 'text_on_button' => "string", 'link' => "string", 'background' => "string"])]
    public function rules(): array
    {
        return [
            'over_insert' => 'bail|max:100',
            'small_description' => 'bail|max:100',
            'description' => 'bail|max:200',
            'text_on_button' => 'bail|max:30',
            'link' => 'bail',
            'background' => 'bail|required|file|image'
        ];
    }
}
