<?php

namespace App\Http\Resources\AdminPanel\News\Trash;

use App\Http\Resources\AdminPanel\News\ShortNewsResource;
use App\Models\AdminPanel\News\News;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class NewsCommentForTrashResource extends JsonResource
{
    public function toArray($request): array
    {
        $user = User::find($this->user_id);
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'parentId' => $this->parent_id,
            'commentText' => $this->comment_text,
            'deletedAt' => $this->deleted_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'news' => new ShortNewsResource(News::withTrashed()->find($this->news_id))
        ];
    }
}
