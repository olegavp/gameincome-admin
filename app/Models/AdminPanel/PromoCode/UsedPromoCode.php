<?php

namespace App\Models\AdminPanel\PromoCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UseUuid as Uuid;

class UsedPromoCode extends Model
{
    use HasFactory, Uuid;
}
