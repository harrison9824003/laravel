<?php

namespace App\Http\Controllers;

// use App\Models\Member;
use Illuminate\Http\Request;
use Validator;
use App\Shop\Entity\Member;
use Hash;
use Illuminate\Support\Facades\Mail;
//use DB; // 提供方法印出資料
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Shop\Entity\Merchandise;
use Exception;
use Crypt;

class MemberController extends Controller
{
    /**
     * 使用者註冊頁面
     */
    public function signUpPage(){

        $binding = [
            'title' => '註冊'
        ];
        return view('auth.signUp', $binding);

    }

    public function signUpProcess(){

        $input = request()->all();
        
        // 驗證規則
        $rules = [
            'nickname' => [
                'required',
                'max:50'
            ],
            'email' => [
                'required',
                'max:150',
                'email',
                'unique:members,email'
            ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:6'
            ],
            'password_confirmation' => [
                'required',
                'min:6'
            ],
            'type' => [
                'required',
                'in:G,A'
            ]
        ];

        $vaildator = Validator::make($input, $rules);

        if ( $vaildator->fails() ) {
            return redirect('/user/auth/sign-up')
            ->withErrors($vaildator)
            ->withInput();
        }

        $input["password"] = Hash::make($input['password']);

        $Members = Member::create($input);

        $mail_binding = [
            'nickname' => $input['nickname'] ?? $input['name']
        ];

        Mail::send('email.signUpEmailNotification', $mail_binding,
        function($mail) use ($input){
            $mail->to($input['email']);
            $mail->from('harrison9824003@gmail.com');
            $mail->subject('恭喜註冊 product Laravel 成功');
        });

        return redirect('/user/auth/sign-in');

    }

    public function signInPage(){

        $binding = [
            'title' => '登入'
        ];

        return view('auth.signIn', $binding);

    }

    public function signInProcess(){
        
        $input = request()->all();
        
        // 用 email 查詢 type = A 帳號
        $member = Member::where('email', $input['email'])->firstOrFail();            
        
        $is_password_correct = Hash::check($input['password'], $member->password);

        if(!$is_password_correct){
            $error_message = [
                'mag' => '密碼驗證錯誤'
            ];
            return redirect('/usr/auth/sign-in')->withErrors($error_message)->withInput();
        }
        
        session()->put('user_id', $member->id);

        // 生成 token
        $hash_str = '';
        if ($member->_user_check != '' && strtotime($member->_access_token_time) > time() ) {
            $hash_str = $member->_user_check;
        } else {
            $hash_str = Hash::make(time());

            // 更新 token 時間
            $member->_access_token_time = date("Y-m-d H:i:s", strtotime("+ 1 day"));
            $member->_refersh_token_time = date("Y-m-d H:i:s", strtotime("+ 1 day"));
        }
        // 更新 user 驗證碼
        $member->_user_check = $hash_str;

        // 產生 token
        $token = Crypt::encrypt($member->_user_check . '#' . $member->id . '#' . $member->email);
        $member->_token_ = $token;
        $member->update();
        //response()->withCookie((cookie('user_token', $token, 86400)));
        
        // 將未登入購物車加進購物車
        $user_id = $member->id;
        $cookie_id = request()->cookie('laravel_session');

        $member_cart = Cart::where('cart_id', '=', $user_id)->first();
        if ( !$member_cart ) {
            $member_cart = Cart::create([
                'cart_id' => $user_id,
                'content' => ''
            ]);
            //$member_cart->save();
        }
        
        $cookie_cart = Cart::where('cart_id', '=', $cookie_id)->first();

        $m_cart_content = isset($member_cart->content) ? unserialize($member_cart->content) : [];
        $c_cart_content = isset($cookie_cart->content) ? unserialize($cookie_cart->content) : [];
        $m_cart_key = is_array($m_cart_content) ? array_keys($m_cart_content) : [];
        foreach ( $c_cart_content as $key => $c_product) {
            if ( in_array($key, $m_cart_key) && isset($m_cart_content[$key]['cnt']) ) {
                $m_cart_content[$key]['cnt'] += $c_product['cnt'];
            } else {
                $m_cart_content[$key] = $c_product;
            }
        }

        $member_cart->where('cart_id', '=', (String) $user_id)->update(
            [
                'content' => serialize($m_cart_content)
            ]
        );
        
        if( $c_cart_content ) {
            $cookie_cart->where("cart_id", '=', $cookie_id)->delete();        
        }
           

        // 導回原本頁面,若沒有則返回首頁
        return redirect()->intended('/')->withCookie((cookie('user_token', $token, 1440)));

    }

    public function signOut(){

        session()->forget('user_id');
        return redirect('/');

    }

    public function listCart() {

        $binding = [
            'title' => '購物車列表'
        ];
        return view('cart.listcart', $binding);

    }

    public function addCart()
    {
        $input = request()->all();
        $p_id = $input["p_id"];
        $user_id = session()->get('user_id');
        if($user_id == '') $user_id = request()->cookie('laravel_session');
        // $input['user_id'] = $user_id;
        
        $cart = Cart::where('cart_id', $user_id)->first();
        $status = 0;
        $Merchandise = Merchandise::find($p_id);
        $max_cnt = 50;

        try{

            if($cart){

                $cart_ary = unserialize($cart->content);
                if( in_array($input['p_id'], array_keys($cart_ary)) ) {
                    $cart_ary[$p_id]['cnt'] += 1;
                } else {
                    
                    $cart_info = [
                        'id' => $p_id,
                        'name' => $Merchandise->name,
                        'name_en' => $Merchandise->name_en,
                        'price' => $Merchandise->price,
                        'cnt'   => 1
                    ];
    
                    $cart_ary[$p_id] = $cart_info;
                }

                if ( count($cart_ary) > $max_cnt ) {
                    return response()->json([
                        'status' => 0,
                        'errorMsg' => '購物車最多只能加入50筆商品資料',
                        'time' => date("Y-m-d H:i:s")
                    ]);
                }
    
                $cart->content = serialize($cart_ary);
                $cart->where('cart_id', '=', (String) $user_id)->update(
                    [ 
                        'content' => $cart->content,
                    ]
                );
                $status = 1;
    
            } else {

                $cart = new Cart();
                $cart->cart_id = $user_id;
                
                $cart_info = [
                    'id' => $p_id,
                    'name' => $Merchandise->name,
                    'name_en' => $Merchandise->name_en,
                    'price' => $Merchandise->price,
                    'cnt'   => 1
                ];
    
                $cart->content = serialize($cart_info);
                $cart->save();
                $status = 1;    

    
            }
    
            return response()->json([
                'status' => $status,
                'p_id' => $p_id,
                'p_name' => $Merchandise->name,
                'time' => date("Y-m-d H:i:s")
            ]);

        }catch(Exception $e){

            return response()->json([
                'status' => 0,
                'errorMsg' => $e->getMessage(),
                'time' => date("Y-m-d H:i:s")
            ]);

        }
        
    }
}
