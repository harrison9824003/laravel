<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;
use App\Traits\HasFrontData;

class Product extends Model
{
    use HasFactory;
    use HasModelId;
    use HasFrontData;

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
        'user_id',
    ];

    public function images()
    {
        $model_app = app(\App\Models\Shop\Product::class);
        return $this->hasMany(\App\Models\Shop\ProductImage::class, 'item_id', 'id')
            ->where('data_id', $model_app->getModelId());
    }

    public function category()
    {
        return $this->hasOneThrough(
            \App\Models\Category::class,
            \App\Models\RelationShipCatory::class,
            'item_id',
            'id',
            'id',
            'category_id'
        );
    }

    public function relationship()
    {
        $model_app = app(\App\Models\Shop\Product::class);
        return $this->hasOne(\App\Models\RelationShipCatory::class, ['data_id', 'item_id'], [$model_app->getModelId(), 'id']);
    }

    public function specs()
    {
        return $this->hasMany(\App\Models\Shop\ProductSpec::class, 'product_id', 'id');
    }

    /**
     * 回傳前台統一格式
     *
     * category: 網站總分類
     * title: 資料標題
     * sub_title: 資料副標題
     * create: 建立時間
     * update: 建立時間
     * create_person: 建立人員
     * update_person: 修改人員
     * content: 主內容
     * simple_content: 簡介內容
     * other: 其他內容 e.g. 商品的規格、分類等, 由頁面本身判斷顯示
     */
    public function getFrontData()
    {

        return [
            'category' => strip_tags($this->category->name),
            'title' => strip_tags($this->name),
            'sub_title' => null,
            'create' => date("Y-m-d", strtotime($this->created_at)),
            'update' =>  date("Y-m-d", strtotime($this->updated_at)),
            'create_person' => null,
            'update_person' => null,
            'content' => $this->intro,
            'simple_content' => strip_tags($this->simple_intro),
            'other' => [
                'images' => $this->images,
                'specs' => $this->specs
            ]
        ];
    }
}
