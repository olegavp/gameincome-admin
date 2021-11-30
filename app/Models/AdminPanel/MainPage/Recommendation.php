<?php

namespace App\Models\AdminPanel\MainPage;

use App\Models\Concerns\UseUuid as Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
    use HasFactory, Uuid;

    protected $table = 'main_page_recommendations';

    public $timestamps = false;
}
