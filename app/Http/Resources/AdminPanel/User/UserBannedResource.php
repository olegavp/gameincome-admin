<?php

namespace App\Http\Resources\AdminPanel\User;

use App\Http\Resources\AdminPanel\News\NewsCommentResource;
use App\Http\Resources\User\PersonalArea\Finance\BalanceResource;
use App\Models\AdminPanel\News\NewsComment;
use App\Models\Seller\Seller;
use App\Models\User\PersonalArea\Finance\UserBalance;
use App\Models\User\PersonalArea\Purchase\Purchase;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBannedResource extends JsonResource
{
    public function toArray($request): array
    {
        $isSeller = Seller::query()->where('user_id', $this->user->id)->get();
        if ($isSeller->isNotEmpty())
        {
            $isSeller = 1;
        }
        else
        {
            $isSeller = 0;
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'email' => $this->user->email,
            'nickname' => $this->user->nickname,
            'createdAt' => $this->user->created_at,
            'updatedAt' => $this->user->updated_at,
            'balance' => new BalanceResource(UserBalance::query()->where('user_id', $this->user->id)->first()),
            'cause' => $this->cause,
            'isSeller' => $isSeller,
            'numberOfItemsSold' => Purchase::query()->where('seller_id', $this->user->id)->count(),
            'allComments' => NewsCommentResource::collection(NewsComment::query()->withTrashed()->where('user_id', $this->user->id)->get()),
            'messages' => 232312,
        ];
    }
}
