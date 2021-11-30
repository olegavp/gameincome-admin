<?php

namespace App\Models\AdminPanel\Appeals\Dispute;

use App\Models\Concerns\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisputeAppealMessage extends Model
{
    use HasFactory, UseUuid;

    protected $table = 'dispute_appeals_messages';
}
