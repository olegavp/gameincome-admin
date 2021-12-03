<?php

namespace App\Models\AdminPanel\News;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\UseUuid as Uuid;

class NewsComment extends Model
{
    use HasFactory, SoftDeletes, Uuid;


    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id', 'id')->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
