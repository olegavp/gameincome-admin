<?php

namespace App\Models;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPageCategory extends Model
{
    use HasFactory, useUuid;

    protected $table = 'main_page_categories';

    protected $fillable = [
        'category_id',
        'background'
    ];

    public $timestamps = false;
}
