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
        'content'
    ];
}
