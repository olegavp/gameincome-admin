<?php

namespace App\Models\AdminPanel\Appeals\General;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralAppealMessage extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'general_appeals_messages';

    protected $fillable = ['closed_at'];
}
