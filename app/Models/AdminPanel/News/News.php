<?php

namespace App\Models\AdminPanel\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\UseUuid as Uuid;

class News extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $fillable = [
        'name',
        'description_on_3_words',
        'small_description',
        'description',
        'type',
        'relation',
        'small_background',
        'background'
    ];


    public function newsComments(): HasMany
    {
        return $this->HasMany(NewsComment::class, 'news_id')->withTrashed()->orderBy('created_at', 'ASC');
    }
}
