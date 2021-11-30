<?php

namespace App\Http\Resources\AdminPanel\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class PlatformsResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'slug' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
