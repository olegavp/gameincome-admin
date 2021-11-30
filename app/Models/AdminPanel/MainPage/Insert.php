<?php

namespace App\Models\AdminPanel\MainPage;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insert extends Model
{
    use HasFactory, useUuid;

    protected $table = 'main_page_inserts';

    protected $fillable = [
        'over_insert',
        'small_description',
        'description',
        'text_on_button',
        'link',
        'background'
    ];

    public $timestamps = false;
}
