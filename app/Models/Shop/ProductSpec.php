<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasFactory;

    protected $table = "pj_product_spec";

    protected $fillable = [
        'category_id',
        'product_id',
        'reserve_num',
        'low_reserve_num',
        'volume',
        'weight',
        'order'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Shop\Product::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Shop\SpecCategory::class);
    }
}
