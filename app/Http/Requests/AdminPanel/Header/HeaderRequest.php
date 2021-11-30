<?php

namespace App\Http\Requests\AdminPanel\Header;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class HeaderRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'slug' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:8|unique:main_page_headers_link',
            'slug' => 'bail|required|string|max:15|unique:main_page_headers_link',
        ];
    }
}
