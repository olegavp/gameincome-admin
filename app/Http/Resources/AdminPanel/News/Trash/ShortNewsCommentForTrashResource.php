<?php

namespace App\Http\Resources\AdminPanel\News\Trash;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class ShortNewsCommentForTrashResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'newsId' => "mixed", 'nickname' => "mixed", 'email' => "mixed", 'commentText' => "mixed", 'deletedAt' => "mixed", 'createdAt' => "mixed", 'updatedAt' => "mixed"])]
    public function toArray($request): array
    {
        $user = User::find($this->user_id);
        return [
            'id' => $this->id,
            'newsId' => $this->news_id,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'commentText' => $this->comment_text,
            'deletedAt' => $this->created_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
