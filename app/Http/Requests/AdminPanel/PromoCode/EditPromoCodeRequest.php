<?php

namespace App\Http\Requests\AdminPanel\PromoCode;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EditPromoCodeRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'count' => "string", 'money' => "string", 'finish_time' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'bail|string|max:50',
            'count' => 'bail|digits_between:0,10',
            'money' => 'bail|digits_between:0,10',
            'finish_time' => 'bail'
        ];
    }
}
