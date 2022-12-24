<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'pj_members';

    protected $fillable = [
        'firstname',
        'lastname',
        'telephone',
        'account',
        'email',
        'pwd',
        'address',
        'city',
        'postCode',
        'country',
        'regionState',
        'login_time'
    ];
}
