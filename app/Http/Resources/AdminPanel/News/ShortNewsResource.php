<?php

namespace App\Http\Resources\AdminPanel\News;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ShortNewsResource extends JsonResource
{
    #[ArrayShape(['newsId' => "mixed", 'newsName' => "mixed", 'newsDescriptionOn3Words' => "mixed", 'newsSmallDescription' => "mixed", 'newsSmallBackground' => "mixed", 'newsCreatedAt' => "mixed", 'newsUpdatedAt' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'newsId' => $this->id,
            'newsName' => $this->name,
            'newsDescriptionOn3Words' => $this->description_on_3_words,
            'newsSmallDescription' => $this->small_description,
            'newsSmallBackground' => $this->small_background,
            'newsCreatedAt' => $this->created_at,
            'newsUpdatedAt' => $this->updated_at,
        ];
    }
}
