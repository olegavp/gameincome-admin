<?php

namespace App\Http\Resources\AdminPanel\PromoCode;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class PromoCodeResource  extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'count' => "mixed", 'money' => "mixed", 'finishTime' => "mixed", 'createdAt' => "mixed", 'updatedAt' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'count' => $this->count,
            'money' => $this->money,
            'finishTime' => $this->finish_time,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
