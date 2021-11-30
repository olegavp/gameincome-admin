<?php

namespace App\Models\Product\Item;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameKey extends Model
{
    use HasFactory, softdeletes, useUuid;
}
