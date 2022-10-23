<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationShipCatory extends Model
{
    use HasFactory;

    protected $table = 'pj_relationship_category';

    protected $fillable = [
        'data_id',
        'category_id',
        'item_id'
    ];
    
}
