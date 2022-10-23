<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'item_id',
        'path',
        'data_type',
        'description'
    ];
}
