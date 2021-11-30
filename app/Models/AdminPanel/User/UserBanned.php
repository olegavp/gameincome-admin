<?php

namespace App\Models\AdminPanel\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Concerns\UseUuid as Uuid;

class UserBanned extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $table = 'users_banned';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
