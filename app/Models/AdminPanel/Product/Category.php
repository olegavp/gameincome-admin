<?php

namespace App\Models\AdminPanel\Product;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, UseUuid;

    public $timestamps = false;
}
