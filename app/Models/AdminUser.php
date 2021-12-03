<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property timestamp $email_verified_at
 * @property string $password
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property string $remember_token
 *
 * @property timestamp $created_at
 * @property timestamp $updated_at
 *
 * @property-read string $full_name
 */
class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $appends = [
        'full_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->name . '(' . $this->email . ')';
    }
}

