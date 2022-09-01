<?php

namespace App\Http\Controllers;

use App\Shop\Entity\Transaction;
use App\Models\TransactionDetail;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\Member;
use App\Models\Cart;
use Exception;
// use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function transactionListPage()
    {
        $user_id = session()->get('user_id');

        $row_per_page = 10;

        $TransactionPaginate = Transaction::where('user_id', $user_id)
        ->OrderBy('created_at', 'desc')
        ->with('transaction_detail')
        ->paginate($row_per_page);
        
        foreach ( $TransactionPaginate as &$Transaction) {
            foreach( $Transaction->transaction_detail as &$product ) {
                $product_detail = $product->Merchandise->toArray();
                $product->photo = $product_detail['photo'];
                $product->name = $product_detail['name'];
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

        try{

            extract($input);
            $Merchandises = json_decode($final_list, true);
            // $Meta_data = json_decode($final_meta, true);

            $user_id = session()->get('user_id');
            $member = Member::find($user_id);

            $transaction = [
                "user_id" => $user_id,
                "send_user" => $send_user,
                "send_email" => $send_email,
                "user" => $user,
                "email" => $email,
                "address" => $address,            
                "total_price" => $total_money,
                "buy_count" => count($Merchandises),
                "delivery_money" => $delivery_money,
            ];
            
            $transaction_create = Transaction::create($transaction);

            // 移除購物車內容
            $cart = Cart::where('cart_id', '=', $user_id)->first();            
            $cart_content = unserialize($cart->content);

            foreach ( $Merchandises as $Merchandise ) {

                // $T_Merchandise = Merchandise::find($Merchandise->id);

                $detail_input = [
                    'transaction_id' => $transaction_create->id,
                    'product_id' => $Merchandise['id'],
                    'num' => $Merchandise['num'],
                    'price' => $Merchandise['price']
                ];

                $transaction_detail_create = TransactionDetail::create($detail_input);
                unset($cart_content[$Merchandise['id']]);
            }

            // 更新購物車內容
            $cart->where('cart_id', '=', $user_id)->update([
                'content' => serialize($cart_content)
            ]);

            $mail_binding = [
                'name' => $member->name,
                'transaction_id' => $transaction_create->id,
                'products' => $Merchandises,
                'delivery_money' => $delivery_money,
                "total_price" => $total_money,
            ];
    
            Mail::send('email.successTransaction', $mail_binding,
            function($mail) use ($member){
                $mail->to($member->email);
                $mail->from('harrison9824003@gmail.com');
                $mail->subject('您的交易訂單已成立');
            });

            return redirect('/user/auth/list-cart')
            ->with('successMsg', '訂單建立成功');

        }catch(Exception $e){

            return redirect('/user/auth/list-cart')
            ->with('errors', [$e->getMessage]);

        }  

    }
}
