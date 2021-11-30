<?php

namespace App\Http\Resources\AdminPanel\MainPage;

use App\Models\AdminPanel\MainPage\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class CategoriesResource extends JsonResource
{
    public function toArray($request): array
    {
        $category = Category::query()->find($this->category_id);

        return [
            'id' => $this->id,
            'name' => $category->name,
            'background' => $this->background
        ];
    }
}
