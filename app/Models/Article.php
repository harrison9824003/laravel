<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;
use App\Traits\HasFrontData;

class Article extends Model
{
    use HasFactory;
    use HasModelId;
    use HasFrontData;

    protected $table = 'pj_article';

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'content',
        'sub_title',
        'is_active',
    ];

    public function category()
    {
        return $this->hasOneThrough(
            \App\Models\Categroy::class,
            \App\Models\RelationShipCatory::class,
            'item_id',
            'id',
            'id',
            'category_id'
        );
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
            'title' => strip_tags($this->title),
            'sub_title' => strip_tags($this->sub_title),
            'create' => date("Y-m-d", strtotime($this->created_at)),
            'update' =>  date("Y-m-d", strtotime($this->updated_at)),
            'create_person' => null,
            'update_person' => null,
            'content' => $this->content,
            'simple_content' => mb_substr(strip_tags($this->simple_intro), 0, 50)
        ];
    }
}
