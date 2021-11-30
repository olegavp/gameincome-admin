<?php

namespace App\Http\Requests\AdminPanel\MainPage;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateSliderRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'small_description' => "string", 'description' => "string", 'text_on_button' => "string", 'link' => "string", 'preview_background' => "string", 'background' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|bail|string|max:40',
            'small_description' => 'required|bail|string|max:80',
            'description' => 'required|bail|string|max:200',
            'text_on_button' => 'bail|max:30',
            'link' => 'bail',
            'preview_background' => 'required|bail|file|image',
            'background' => 'required|bail|file|image'
        ];
    }
}
