<?php

namespace App\Http\Requests\AdminPanel\Review;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'bail|string|max:110',
            'description' => 'bail|string',
        ];
    }
}
