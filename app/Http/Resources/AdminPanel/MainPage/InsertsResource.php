<?php

namespace App\Http\Resources\AdminPanel\MainPage;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class InsertsResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'overInsert' => "mixed", 'smallDescription' => "mixed", 'description' => "mixed", 'textOnButton' => "mixed", 'link' => "mixed", 'background' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'overInsert' => $this->over_insert,
            'smallDescription' => $this->small_description,
            'description' => $this->description,
            'textOnButton' => $this->text_on_button,
            'link' => $this->link,
            'background' => $this->background
        ];
    }
}
