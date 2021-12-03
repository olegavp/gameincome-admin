<?php

namespace App\Models\AdminPanel\Review;

use App\Models\AdminPanel\Review\Enums\ItemTypeEnum;
use App\Models\AdminUser;
use App\Models\Concerns\UseUuid;
use App\Models\Product\Item\Game;
use App\Models\Product\Item\Skin;
use App\Models\Product\Item\Software;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $item_id
 * @property string $item_type
 * @property string $writer_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class Review extends Model
{
    use HasFactory, useUuid;

    protected $fillable = [
        'name',
        'description',
        'item_id',
        'item_type',
        'writer_id',
    ];

    protected $appends = [
        'item',
        'item_type_name',
    ];

    public function writer(): HasOne
    {
        return $this->HasOne(AdminUser::class, 'id', 'writer_id');
    }

    public function comments(): HasMany
    {
        return $this->HasMany(ReviewComment::class, 'review_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function views(): HasOne
    {
        return $this->HasOne(ReviewView::class, 'review_id', 'id');
    }

    public function getItemAttribute(): ?Model
    {
        if ($this->item_type === ItemTypeEnum::ITEM_GAME) {
            return Game::query()->where('id', $this->item_id)->first();
        } elseif ($this->item_type === ItemTypeEnum::ITEM_SOFTWARE) {
            return Software::query()->where('id', $this->item_id)->first();
        } elseif ($this->item_type === ItemTypeEnum::ITEM_SKIN) {
            return Skin::query()->where('id', $this->item_id)->first();
        } else {
            return null;
        }
    }

    public function getItemTypeNameAttribute(): string
    {
        return ItemTypeEnum::ITEM_TYPES[$this->item_type] ?? 'Не определено';
    }
}
