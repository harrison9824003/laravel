<?php

namespace App\Models\Shop;

use App\Models\DataType;
use App\Models\MyImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

class Product extends Model
{
    use HasFactory,HasModelId;

    protected $table = 'pj_product';
    
    protected $fillable = [
        'name',
        'price',
        'market_price',
        'simple_intro',
        'intro',
        'part_number',
        'start_date',
        'end_date',
    ];

    public function images()
    {
        $images = MyImage::where('item_id', $this->id)->where('data_id', $this->get_model_id())->get();
        return $images;
    }

    public function category() {
        return $this->hasOneThrough(\App\Models\Categroy::class, \App\Models\RelationShipCatory::class, 'item_id', 'id', 'id', 'category_id');
    }

    public function specs() {
        return $this->hasMany(\App\Models\Shop\ProductSpec::class, 'product_id', 'id');
    }
}
