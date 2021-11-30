<?php

namespace App\Http\Resources\AdminPanel\Header;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class HeaderResource extends JsonResource
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
