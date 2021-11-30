<?php

namespace App\Http\Requests\AdminPanel\Header;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditHeaderRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'slug' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|string|max:8|unique:main_page_headers_link',
            'slug' => 'bail|string|max:15|unique:main_page_headers_link',
        ];
    }
}
