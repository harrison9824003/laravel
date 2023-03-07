<?php

namespace App\Http\Controllers\Member;

use App\Crypt\Openssl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\Register as Request;
use App\Models\Shop\Member;
use Illuminate\Http\Exceptions\HttpResponseException;
use PDOException;

class Register extends Controller
{
    public function __construct(private Openssl $crypt)
    {
    }

    public function __invoke(Request $request)
    {
        $input = $request->post();

        $input['email'] = $this->crypt->myEncrypt($input['email']);
        $input['telephone'] = $this->crypt->myEncrypt($input['telephone']);

        // 檢查資料庫是否有相同
        $checkExists = [];
        if (Member::where('email', $input['email'])->exists()) {
            $checkExists[] = 'email';
        }
        if (count($checkExists)) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'email' => ['email 帳號已註冊過']
                ],
                'status' => 0,
                'message' => 'email 帳號已註冊過'
            ], 200));
        }       

        try {
            $member = Member::create($input);
        } catch (PDOException $e) {
            // todo 錯誤訊息多國語言
            throw new HttpResponseException(response()->json([
                'errors' => ['新增 member 失敗'],
                'status' => 0,
                'message' => $e->getMessage()
            ], 200));
        }

        return response()->json([
            'errors' => '',
            'status' => 1,
            'message' => '成功新增 member'
        ], 200);
    }
}
