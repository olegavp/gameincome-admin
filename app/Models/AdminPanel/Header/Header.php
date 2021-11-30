<?php

namespace App\Models\AdminPanel\Header;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UseUuid as Uuid;

class Header extends Model
{
    use HasFactory, Uuid;

    protected $table = 'main_page_headers_link';

    public $timestamps = false;
}
