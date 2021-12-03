<?php

namespace App\Models\Product\Item;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory, UseUuid;

    public $timestamps = false;
}
