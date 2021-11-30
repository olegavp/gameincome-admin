<?php

namespace App\Http\Resources\AdminPanel\MainPage;

use App\Models\Product\Item\Game;
use App\Models\Product\Item\Software;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class NoveltiesResource extends JsonResource
{
    #[ArrayShape(['noveltyId' => "mixed", 'itemId' => "mixed", 'itemName' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemDeveloper' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemScore' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemBackground' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed"])]
    public function toArray($request): array
    {
        $game = Game::query()->find($this->item_id);
        if ($game != null)
        {
            $item = $game;
        }
        else
        {
            $item = Software::query()->find($this->item_id);
        }

        return [
            'noveltyId' => $this->id,
            'itemId' => $this->item_id,
            'itemName' => $item->name,
            'itemDeveloper' => $item->developer,
            'itemScore' => $item->metacrtic,
            'itemBackground' => $item->header_image
        ];
    }
}
