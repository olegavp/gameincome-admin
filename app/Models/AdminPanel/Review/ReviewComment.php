<?php

namespace App\Models\AdminPanel\Review;

use App\Models\Concerns\UseUuid;
use App\Models\User;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $review_id
 * @property string $user_id
 * @property string $parent_id
 * @property string $comment_text
 *
 * @property timestamp $deleted_at
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class ReviewComment extends Model
{
    use HasFactory, SoftDeletes, useUuid;

    protected $table = 'reviews_comments';

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'review_id', 'id')->withTrashed();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
