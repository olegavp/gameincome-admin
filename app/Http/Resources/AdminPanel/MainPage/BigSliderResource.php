<?php

namespace App\Http\Resources\AdminPanel\MainPage;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class BigSliderResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'name' => "mixed", 'smallDescription' => "mixed", 'description' => "mixed", 'text_on_button' => "mixed", 'link' => "mixed", 'previewBackground' => "mixed", 'background' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'smallDescription' => $this->small_description,
            'description' => $this->description,
            'text_on_button' => $this->text_on_button,
            'link' => $this->link,
            'previewBackground' => $this->preview_background,
            'background' => $this->background
        ];
    }
}
