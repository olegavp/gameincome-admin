<?php

namespace App\Http\Requests\AdminPanel\Review;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditReviewRequest extends FormRequest
{
    #[ArrayShape([
        'name' => "string",
        'description' => "string",
        'item_type' => "string",
        'item_id' => "string",
    ])] public function rules(): array
    {
        return [
            'name' => 'bail|string|max:110',
            'description' => 'bail|string',
            'item_type' => 'required|bail|string',
            'item_id' => 'required|bail|string',
        ];
    }
}
