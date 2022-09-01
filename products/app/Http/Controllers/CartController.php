<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Shop\Entity\Member;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = request()->all();
        $user_id = session()->get('user_id');

        if ( isset($input['pageCnt']) ) $pageCnt = $input['pageCnt'];
        else $pageCnt = 0;

        if($user_id) $user_id = request()->cookie('laravel_session');
        else {
            // 有登入使用者
            // 檢查 token
            $user = Member::find($user_id);
            $chk_token = request()->cookie('user_token');

            // 檢查
            if ( $user->_token_ != $chk_token ) {
                return response()->json([
                    'status' => 0,
                    'errorMsg' => 'errorToken',
                    'time' => date("Y-m-d H:i:s")
                ]);
            }

        }
        
        // 取購物車資料
        $cart = Cart::where('cart_id', '=', $user_id)->first();
        $cart_content = unserialize($cart->content);
        $cart_cnt = count($cart_content);
        if($pageCnt) {
            $cart_content = array_slice($cart_content, 0, $pageCnt);
        }

        //
        return response()->json([
            'status' => 1,
            'cart_cnt' => $cart_cnt,
            'cart_data' => $cart_content,
            'time' => date("Y-m-d H:i:s")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd('1');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd('2');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
        dd('3');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
        dd('4');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
        dd('5');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
        dd('6');
    }
}
