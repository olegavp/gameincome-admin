<?php

namespace App\Http\Resources\AdminPanel\User\Trash;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ShortUserBannedForTrashResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'user_id' => "mixed", 'name' => "mixed", 'surname' => "mixed", 'email' => "mixed", 'nickname' => "mixed", 'cause' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'email' => $this->user->email,
            'nickname' => $this->user->nickname,
            'cause' => $this->cause
        ];
    }
}
