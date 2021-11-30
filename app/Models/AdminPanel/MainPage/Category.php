<?php

namespace App\Models\AdminPanel\MainPage;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, useUuid;

    protected $fillable = [
        'category_id',
        'background'
    ];

    public $timestamps = false;
}
