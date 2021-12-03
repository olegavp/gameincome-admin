<?php

namespace App\Http\Requests\AdminPanel\Review;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateReviewRequest extends FormRequest
{
    #[ArrayShape([
        'name' => "string",
        'description' => "string",
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required|bail|string|max:110',
            'description' => 'required|bail|string',
        ];
    }
}
