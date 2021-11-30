<?php

namespace App\Models\AdminPanel\Appeals\Partnership;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipAppealMessage extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'partnership_appeals_messages';

    protected $fillable = ['closed_at'];
}
