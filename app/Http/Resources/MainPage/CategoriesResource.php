<?php

namespace App\Http\Resources\MainPage;

use App\Models\MainPage\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class CategoriesResource extends JsonResource
{
    #[ArrayShape(['name' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'background' => "mixed"])]
    public function toArray($request): array
    {
        $category = Category::query()->find($this->category_id);

        return [
            'name' => $category->name,
            'background' => $this->background
        ];
    }
}
