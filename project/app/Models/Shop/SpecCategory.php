<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;

class SpecCategory extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_spec_category';

    protected $fillable = [
        'parent_id',
        'name'
    ];

    public function childens()
    {
        return $this->hasMany(SpecCategory::class, 'parent_id');
    }

    public function parent($id)
    {
        return SpecCategory::Find($id);
    }
}
