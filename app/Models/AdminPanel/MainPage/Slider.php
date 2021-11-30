<?php

namespace App\Models\AdminPanel\MainPage;

use App\Models\Concerns\UseUuid as Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, Uuid;

    protected $table = 'main_page_slider';

    protected $fillable = [
        'name',
        'small_description',
        'description',
        'text_on_button',
        'link',
        'preview_background',
        'background'
    ];

    public $timestamps = false;
}
