<?php

namespace App\Http\Requests\AdminPanel\Review;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateReviewRequest extends FormRequest
{
    #[ArrayShape([
        'name' => "string",
        'description' => "string",
        'item_type' => "string",
        'item_id' => "string",
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required|bail|string|max:110',
            'description' => 'required|bail|string',
            'item_type' => 'required|bail|string',
            'item_id' => 'required|bail|string',
        ];
    }
}
