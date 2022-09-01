<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'buy_count',
        'total_price',
        'send_user',
        'send_email',
        'user',
        'email',
        'address',
        'delivery_money'
    ];
    
    public function transaction_detail() {
        return $this->hasMany('App\Models\TransactionDetail', 'transaction_id', 'id');
    }
}