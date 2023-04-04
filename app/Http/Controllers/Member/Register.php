<?php

namespace App\Http\Controllers\Member;

use App\Crypt\Crypt;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\Register as Request;
use App\Models\Shop\Member;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class Register extends Controller
{
    use RegistersUsers;
    
    public function __construct(private Crypt $crypt)
    {
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createUser(array $data)
    {
        if (User::where('name', $data['account'])->exists()) {
            throw new Exception('account 帳號已註冊過');
        }

        return User::create([
            'name' => $data['account'],
            'email' => $data['email'],
            'password' => $this->crypt->myEncrypt($data['pwd']),
            'is_admin' => 0
        ]);
    }

    /**
     * 會員基本資料
     */
    protected function createMember(array $data)
    {
        $data['email'] = $this->crypt->myEncrypt($data['email']);
        if(!empty($data['telephone'])) {
            $data['telephone'] = $this->crypt->myEncrypt($data['telephone']);
        }

        // 檢查資料庫是否有相同
        if (Member::where('email', $data['email'])->exists()) {
            throw new Exception('email 帳號已註冊過');
        }

        return Member::create($data);
    }

    public function __invoke(Request $request)
    {
        $input = $request->post();

        try {
            DB::beginTransaction();
            $user = $this->createUser($input);
            $member = $this->createMember($input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // todo 錯誤訊息多國語言
            throw new HttpResponseException(response()->json([
                'errors' => [$e->getMessage()],
                'status' => 0,
                'message' => '新增 member 失敗'
            ], 200));
        }

        return response()->json([
            'errors' => '',
            'status' => 1,
            'message' => '成功新增 member'
        ], 200);
    }
}
