<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'num',
        'price'
    ];

    public function Merchandise()
    {
        return $this->hasOne('App\Shop\Entity\Merchandise', 'id', 'product_id');
    }
}
