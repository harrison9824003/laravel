<?php

namespace App\Http\Controllers;

use App\Shop\Entity\Transaction;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\Member;
use Illuminate\Http\Request;
use Validator;

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

    public function transaction()
    {
        $request = request()->all();
        extract($request);
        $checkId = array_flip($checkId);

        // $cartCheckBox 有勾選的商品
        // $checkNumber 購買數量
        // $checkId input hidden 商品 id

        //整理有勾選商品
        $final_list = [];
        $final_meta = ['total'=>0, 'delivery_money' => 100];
        $Merchandises = Merchandise::whereIn('id', value($cartCheckBox))->get();
        foreach ($Merchandises as $Merchandise) {
            $m_id = $Merchandise->id;
            $tmp_product = [];
            // 商品 id
            $tmp_product['id'] = $m_id;

            // 商品名稱
            $tmp_product['name'] = $Merchandise->name;

            // 商品數量
            $tmp_product['num'] = $checkNumber[$checkId[$m_id]];

            // 商品價格
            $tmp_product['price'] = $Merchandise->price;

            // 商品總金額
            $tmp_product['p_total'] = $Merchandise->price * $tmp_product['num'];

            // 訂單總金額
            $final_meta['total'] += $tmp_product['p_total'];
            $final_meta['delivery_money'] = $final_meta['total'] > 500 ? 0 : 100;

            $final_list[] = $tmp_product;
        }

        $user_id = session()->get('user_id');
        $User = Member::find($user_id);        
        $output_user = [
            'name' => $User->nickname,
            'email' => $User->email
        ];

        $binding = [
            'title' => '商品結帳',
            'final_list' => $final_list,
            'final_meta' => $final_meta,
            'user_info' => $output_user
        ];
        
        return view('transaction.buy', $binding);
    }

    public function buy()
    {
        $input = request()->all();

        // 驗證規則
        $rules = [
            'send_user' => [
                'required',
                'max:50'
            ],
            'send_email' => [
                'required',
                'max:150',
                'email'
            ],
            'user' => [
                'required',
                'max:50'
            ],
            'email' => [
                'required',
                'max:150',
                'email'
            ],
            'address' => [
                'required',
                'max:150',
            ]
        ];

        $vaildator = Validator::make($input, $rules);

        if ( $vaildator->fails() ) {
            return redirect('/user/auth/list-cart')
            ->withErrors($vaildator)
            ->withInput();
        }

        extract($input);
        echo "<pre>";
        print_r($input);exit;
    }
}
