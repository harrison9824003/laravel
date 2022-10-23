<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

/**
 * 商品規格分類
 * 提供給商品設定時選擇分類
 */
class SpecCategory extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_spec_category';

    protected $fillable = [
        'parent_id',
        'name'
    ];

    public function childern()
    {
        return $this->hasMany(\App\Models\Shop\SpecCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(\App\Models\Shop\SpecCategory::class, 'id', 'parent_id');
    }
}
