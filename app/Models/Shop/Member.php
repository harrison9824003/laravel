<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Laravel\Sanctum\HasApiTokens;

class Member extends User
{
    use HasFactory;
    use HasApiTokens;

    protected $table = 'pj_members';

    protected $fillable = [
        'firstname',
        'lastname',
        'telephone',
        'email',
        'address',
        'city',
        'postCode',
        'country',
        'regionState',
        'login_time'
    ];
}
