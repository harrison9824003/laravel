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
        'order',
        'display'
    ];

    public function category() {
        return $this->hasMany(\App\Models\RelationShipCatory::class, 'category_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(\App\Models\Categroy::class);
    }

    public function childern()
    {
        return $this->hasMany(\App\Models\Categroy::class, 'parent_id', 'id');
    }
}