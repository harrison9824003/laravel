<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fallable = [
        'name',
        'account',
        'email',
        'pwd',
        'login_time'
    ];
}
