<?php

namespace App\Http\Resources\AdminPanel\News\Trash;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class NewsForTrashResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'descriptionOn3Words' => $this->description_on_3_words,
            'smallDescription' => $this->small_description,
            'description' => $this->description,
            'type' => $this->type,
            'background' => $this->background,
            'deletedAt' => $this->deleted_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
