<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasModelId;
use App\Models\DataTypeFolder;

class DataType extends Model
{
    use HasFactory, HasModelId;

    protected $table = 'pj_data_type';

    protected $fillable = [
        'id',
        'name',
        'class_name',
        'disabled',
        'icon',
        'folder_id',
        'router_path'
    ];

    public function folder(){
        return $this->hasOne(DataTypeFolder::class, 'id', 'folder_id');
    }
}
