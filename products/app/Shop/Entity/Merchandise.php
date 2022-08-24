<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchandise extends Model
{
    use HasFactory;
    protected $table = 'merchandises';

    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'status',
        'name',
        'name_en',        
        'introduction',
        'introduction_en',
        'photo',
        'price',
        'remain_count',
    ];
}
