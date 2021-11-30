<?php

namespace App\Models\AdminPanel\Appeals\Technical;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalAppeal extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'tech_support_appeals';

    protected $fillable = ['closed_at'];
}
