<?php

namespace App\Http\Resources\AdminPanel\News\Trash;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ShortNewsForTrashResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'descriptionOn3Words' => "mixed", 'smallDescription' => "mixed", 'type' => "mixed", 'deletedAt' => "mixed", 'createdAt' => "mixed", 'updatedAt' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'descriptionOn3Words' => $this->description_on_3_words,
            'smallDescription' => $this->small_description,
            'type' => $this->type,
            'deletedAt' => $this->created_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
