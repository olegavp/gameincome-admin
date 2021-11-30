<?php

namespace App\Http\Requests\AdminPanel\News;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|bail|string|max:110',
            'descriptionOn3Words' => 'bail|string|max:50',
            'smallDescription' => 'required|bail|string|max:255',
            'description' => 'required|bail|string',
            'relation' => 'required_without:newRelation|bail',
            'newRelation' => 'required_without:relation|bail',
            'smallBackground' => 'required|bail|file|image',
            'background' => 'required|bail|file|image'
        ];
    }
}
