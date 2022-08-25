<?php

namespace App\Http\Controllers;

use App\Shop\Entity\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionListPage()
    {
        $user_id = session()->get('user_id');

        $row_per_page = 10;

        $TransactionPaginate = Transaction::where('user_id', $user_id)
        ->OrderBy('created_at', 'desc')
        ->with('Merchandise')
        ->paginate($row_per_page);

        foreach ( $TransactionPaginate as &$Transaction) {
            if (!is_null($Transaction->Merchandise->photo) && trim($Transaction->Merchandise->photo) != '') {                
                $Transaction->Merchandise->photo = url($Transaction->Merchandise->photo);
            } else {
                $Transaction->Merchandise->photo = '';
            }
        }

        $binding = [
            'title' => '交易紀錄',
            'TransactionPaginate' => $TransactionPaginate
        ];

        return view('transaction.listUserTransaction', $binding);
    }
}
