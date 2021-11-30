<?php

namespace App\Http\Resources\AdminPanel\Ban;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UserBannedResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'user_id' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id
        ];
    }
}
