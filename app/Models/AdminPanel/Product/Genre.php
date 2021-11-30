<?php

namespace App\Models\AdminPanel\Product;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory, UseUuid;

    public $timestamps = false;
}
