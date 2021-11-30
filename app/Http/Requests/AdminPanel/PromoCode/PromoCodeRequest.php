<?php

namespace App\Http\Requests\AdminPanel\PromoCode;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PromoCodeRequest extends FormRequest
{
    #[ArrayShape(['name' => "string", 'count' => "string", 'money' => "string", 'finishTime' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|bail|string|max:50',
            'count' => 'required|bail|digits_between:0,10',
            'money' => 'required|bail|digits_between:0,10',
            'finishTime' => 'bail|date'
        ];
    }
}
