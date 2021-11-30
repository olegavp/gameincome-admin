<?php

namespace App\Http\Resources\MainPage;

use App\Models\Product\Item\Game;
use App\Models\Product\Item\GameKey;
use App\Models\Product\Item\Software;
use App\Models\Product\Item\SoftwareKey;
use Illuminate\Http\Resources\Json\JsonResource;

class HitsResource extends JsonResource
{
    public function toArray($request): array
    {
        $itemInfo = Game::query()->find($this->item_id);

        if ($itemInfo == null)
        {
            $itemInfo = Software::query()->find($this->item_id);
        }

        $keyInfo = GameKey::query()->where('item_id', $this->item_id)
            ->where('service_price', GameKey::query()
                ->where('item_id', $this->item_id)
                ->where('bought', 0)
                ->min('service_price'))
            ->first();
        if ($keyInfo == null)
        {
            $keyInfo = SoftwareKey::query()->where('item_id', $this->item_id)
                ->where('service_price', SoftwareKey::query()
                    ->where('item_id', $this->item_id)
                    ->where('bought', 0)
                    ->min('service_price'))
                ->first();
        }
        if ($keyInfo == null)
        {
            return [
                'itemId' => $this->item_id,
                'itemName' => $itemInfo->name,
                'itemDeveloper' => $itemInfo->developer,
                'itemScore' => $itemInfo->metacritic,
                'itemBackground' => $itemInfo->header_image,
                'itemPrice' => ['old' => 'Нет в наличии', 'new' => null, 'sale' => null]
            ];
        }

        if ($keyInfo->service_sale_price != null)
        {
            $salePrice = $keyInfo->service_sale_price / 100;
            $price = $keyInfo->service_price / 100;
            $sale = round((($price - $salePrice) * 100) / $price);
        }
        else
        {
            $price = $keyInfo->service_price;
            $salePrice = null;
            $sale = null;
        }

        return [
            'itemId' => $this->item_id,
            'itemName' => $itemInfo->name,
            'itemDeveloper' => $itemInfo->developer,
            'itemScore' => $itemInfo->metacritic,
            'itemBackground' => $itemInfo->header_image,
            'itemPrice' => ['old' => $price, 'new' => $salePrice, 'sale' => $sale]
        ];
    }
}
