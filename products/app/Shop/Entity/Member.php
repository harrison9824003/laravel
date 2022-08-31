<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'password',
        'type',
        'nickname',
        '_user_check',
        '_token_',
        '_access_token_time',
        '_refersh_token_time'
    ];
}
