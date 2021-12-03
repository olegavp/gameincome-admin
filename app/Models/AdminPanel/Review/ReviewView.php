<?php

namespace App\Models\AdminPanel\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $review_id
 * @property int $count
 */
class ReviewView extends Model
{
    use HasFactory;

    protected $table = 'reviews_views';

    public $timestamps = false;
}
