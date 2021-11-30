<?php

namespace App\Http\Resources\AdminPanel\News;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class NewsCommentResource extends JsonResource
{
    #[ArrayShape(['commentId' => "mixed", 'commentUserId' => "mixed", 'commentNickname' => "mixed", 'commentParentId' => "mixed", 'commentText' => "mixed|string", 'commentDeletedAt' => "mixed", 'commentCreatedAt' => "mixed", 'commentUpdatedAt' => "mixed"])]
    public function toArray($request): array
    {
        if ($this->deleted_at == !null)
        {
            $text = 'Этот комментарий был удалён пользователем или за нарушение правил площадки.';
        }
        else
        {
            $text = $this->comment_text;
        }

        return [
            'commentId' => $this->id,
            'commentUserId' => $this->user_id,
            'commentNickname' => User::where('id', $this->user_id)->pluck('nickname')[0],
            'commentParentId' => $this->parent_id,
            'commentText' => $text,
            'commentDeletedAt' => $this->deleted_at,
            'commentCreatedAt' => $this->created_at,
            'commentUpdatedAt' => $this->updated_at
        ];
    }
}
