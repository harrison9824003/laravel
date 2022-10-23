<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

class ProductImage extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_image';

    protected $fillable = [
        'data_id',
        'item_id',
        'path',
        'data_type',
        'description',
    ];

    public function datatype()
    {
        return $this->belongsTo(\App\Models\DataType::class, 'id', 'data_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Shop\Product::class, 'id', 'item_id');
    }
}
