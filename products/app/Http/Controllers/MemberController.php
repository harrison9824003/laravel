<?php

namespace App\Http\Controllers;

// use App\Models\Member;
use Illuminate\Http\Request;
use Validator;
use App\Shop\Entity\Member;
use Hash;
use Illuminate\Support\Facades\Mail;
use DB; // 提供方法印出資料

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
                'email'
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

        $Users = Member::create($input);

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

        // 導回原本頁面,若沒有則返回首頁
        return redirect()->intended('/');
    }

    public function signOut(){
        session()->forget('user_id');
        return redirect('/');
    }
}
