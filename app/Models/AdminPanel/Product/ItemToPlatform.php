<?php

namespace App\Models\AdminPanel\Product;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemToPlatform extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'items_to_platforms';

    public $timestamps = false;
}
