<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

class Article extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_article';

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'content',
        'sub_title',
        'is_active',
    ];

    public function category() {
        return $this->hasOneThrough(\App\Models\Categroy::class, \App\Models\RelationShipCatory::class, 'item_id', 'id', 'id', 'category_id');
    }
}
