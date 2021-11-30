<?php

namespace App\Http\Resources\MainPage;

use App\Models\Product\Item\Game;
use App\Models\Product\Item\GameKey;
use App\Models\Product\Item\Software;
use App\Models\Product\Item\SoftwareKey;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class MainPageSellersFeedbacksResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'nickname' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemHeaderImage' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemName' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'itemRating' => "\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|\Illuminate\Support\HigherOrderCollectionProxy|mixed", 'comment' => "mixed", 'createdAt' => "mixed"])]
    public function toArray($request): array
    {
        $nickname = User::query()->find($this->user_id)->nickname;
        $itemInfo = Game::query()->find(GameKey::query()->find($this->key_id)->item_id);

        if ($itemInfo == null)
        {
            $itemInfo = Software::query()->find(SoftwareKey::query()->find($this->key_id)->item_id);
        }

        return [
            'id' => $this->id,
            'nickname' => $nickname,
            'itemHeaderImage' => $itemInfo->header_image,
            'itemName' => $itemInfo->name,
            'itemRating' => $itemInfo->metacritic,
            'comment' => $this->comment,
            'createdAt' => $this->created_at
        ];
    }
}
