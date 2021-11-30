<?php

namespace App\Http\Resources\AdminPanel\News;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'newsId' => $this->id,
            'newsName' => $this->name,
            'newsDescriptionOn3Words' => $this->description_on_3_words,
            'newsSmallDescription' => $this->small_description,
            'newsDescription' => $this->description,
            'newsType' => $this->type,
            'newsSmallBackground' => $this->small_background,
            'newsBackground' => $this->background,
            'newsDeletedAt' => $this->deleted_at,
            'newsCreatedAt' => $this->created_at,
            'newsUpdatedAt' => $this->updated_at,
            'newsComments' => NewsCommentResource::collection($this->newsComments)
        ];
    }
}
