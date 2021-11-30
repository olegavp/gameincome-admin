<?php

namespace App\Http\Requests\AdminPanel\MainPage;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateHitRequest extends FormRequest
{
    #[ArrayShape(['itemId' => "string"])]
    public function rules(): array
    {
        return [
            'itemId' => 'bail|required|string'
        ];
    }
}
