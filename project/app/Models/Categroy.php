<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

class Categroy extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_category';
    protected $fillable = [
        'parent_id',
        'name',
        'order'
    ];

    public function category() {
        return $this->hasMany(\App\Models\RelationShipCatory::class, 'category_id', 'id');
    }
}
