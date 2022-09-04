<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\Transaction;
use App\Shop\Entity\Member;
use Validator;
use DB;
use Exception;
use Intervention\Image\Facades\Image;

class MerchandiseController extends Controller
{

    public function merchandiseItemEditPage($merchandise_id) {

        $Merchandise = Merchandise::findOrFail($merchandise_id);
        
        // 圖片
        if( !is_null($Merchandise->photo) && trim($Merchandise->photo) != '' ) {
            $Merchandise->photo = url($Merchandise->photo);
        } else {
            $Merchandise->photo = '';
        }

        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $Merchandise
        ];

        return view('merchandise.editMerchandise', $binding);

    }
    
    /** 
     * 新建商品表單
    */
    public function merchandiseCreate() {

        $Merchandise = [
            'status'    => 'C',
            'name'      => '',
            'name_en'   => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' => '',
            'price' => 0,
            'remain_count' => 0
        ];

        // $Merchandise = Merchandise::create($merchandise_data);

        // return redirect( '/merchandise/' . $Merchandise->id . '/edit');

        $binding = [
            'title' => '新增商品',
            'Merchandise' => $Merchandise
        ];
        //print_r($binding);exit;
        return view('merchandise.addMerchandise', $binding);

    }

    /**
     * 處理商品新增資料
     */
    public function merchandiseCreateProcess() {

        $input = request()->all();

        $rules = [
            'status' => [
                'required',
                'in:C,S'
            ],
            'name' => [
                'required',
                'max:80'
            ],
            'name_en' => [
                'required',
                'max:80'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'photo' => [
                'file',
                'image',
                'max:10240'
            ],
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ]
        ];

        $validator = Validator::make( $input, $rules);

        if ( $validator->fails() ) {
            return redirect('/merchandise/create')
            ->withErrors($validator)
            ->withInput();
        }

        // 圖片處理
        if ( isset($input['photo'] ) ) {

            $photo = $input['photo'];

            $file_extension = $photo->getClientOriginalExtension();

            $file_name = uniqid() . '.' . $file_extension;

            $file_relative_path = 'images/merchandise/' . $file_name;

            $file_path = public_path($file_relative_path);

            $image = Image::make($photo)->fit(450, 300)->save($file_path);

            $input['photo'] = $file_relative_path;

        }

        $Merchandise = Merchandise::create($input);
        //print_r($input);exit;

        return redirect('/merchandise/' . $Merchandise->id . '/edit');

    }

    public function merchandiseItemUpdateProcess($merchandise_id){

        $Merchandise = Merchandise::findOrFail($merchandise_id);

        $input = request()->all();

        $rules = [
            'status' => [
                'required',
                'in:C,S'
            ],
            'name' => [
                'required',
                'max:80'
            ],
            'name_en' => [
                'required',
                'max:80'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'photo' => [
                'file',
                'image',
                'max:10240'
            ],
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ]
        ];

        $validator = Validator::make( $input, $rules);

        if ( $validator->fails() ) {
            return redirect('/merchandise/' . $Merchandise->id . '/edit')
            ->withErrors($validator)
            ->withInput();
        }

        // 圖片處理
        if ( isset($input['photo'] ) ) {

            $photo = $input['photo'];

            $file_extension = $photo->getClientOriginalExtension();

            $file_name = uniqid() . '.' . $file_extension;

            $file_relative_path = 'images/merchandise/' . $file_name;

            $file_path = public_path($file_relative_path);

            $image = Image::make($photo)->fit(450, 300)->save($file_path);

            $input['photo'] = $file_relative_path;

        }

        $Merchandise->update($input);

        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    public function merchandiseManageListPage() {

        $row_per_page = 10;

        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->paginate($row_per_page);

        foreach ($MerchandisePaginate as &$Merchandise) {
            if ( !is_null($Merchandise->photo) && trim($Merchandise->photo) != '' ) {
                $Merchandise->photo = url($Merchandise->photo);
            } else {           
                $Merchandise->photo = '';
            }            
        }
        
        $binding = [
            'title' => '管理商品',
            'MerchandisePaginate' => $MerchandisePaginate
        ];

        return view('merchandise.manageMerchandise', $binding);
    }

    /**
     * 顯示可販售商品列表
     */

     public function merchandiseListPage(){
        $input = request()->all();
        $row_per_page = 8;

        $query = Merchandise::query();

        if ( isset($input['searchKeyword']) && $input['searchKeyword'] != '' ) {
            $query = $query->where('name', 'like', '%'.$input['searchKeyword'].'%');
        }
        
        $MerchandisePaginate = $query->orderBy('updated_at', 'desc')
        ->where('status', 'S')
        ->paginate($row_per_page);

        foreach ($MerchandisePaginate as &$Merchandise) {
            if ( !is_null($Merchandise->photo) && trim($Merchandise->photo) != '' ) {
                $Merchandise->photo = url($Merchandise->photo);
            } else {
                $Merchandise->photo = url('/images/450_300.png');
            }
        }
        $binding = [
            'title' => '商品列表',
            'MerchandisePaginate' => $MerchandisePaginate, 
            'searchKeyword' => $input['serachKeyword'] ?? ''           
        ];

        return view('merchandise.listMerchandise', $binding);
     }

     public function merchandiseItemPage($merchandise_id)
     {
        $Merchandise = Merchandise::findOrFail($merchandise_id);

        if ( !is_null($Merchandise->photo) && trim($Merchandise->photo) != '' ) {
            $Merchandise->photo = url($Merchandise->photo);
        } else {
            $Merchandise->photo = '';
        }

        $binding = [
            'title' => '商品頁',
            'Merchandise' => $Merchandise,
        ];

        return view('merchandise.showMerchandise', $binding);
     }

     public function merchandiseItemBuyProcess($merchandise_id)
     {
        $input = request()->all();

        $rule = [
            'buy_count' => [
                'required',
                'integer',
                'min:1',
            ]
        ];

        $validator = Validator::make($input, $rule);

        if ( $validator->fails() ) {
            return redirect('merchandise/' . $merchandise_id)
            ->withErrors($validator)
            ->withInput();
        }

        try{

            $member_id = session()->get('user_id');
            $Member = Member::findOrFail($member_id);

            DB::beginTransaction();

            $Merchandise = Merchandise::findOrFail($merchandise_id);

            $buy_cnt = $input['buy_count'];

            $remain_cnt_after_buy = $Merchandise->remain_count - $buy_cnt;
            
            if ( $remain_cnt_after_buy < 0 ) {
                throw new Exception('商品數量不足, 無法購買');
            }

            $Merchandise->remain_count = $remain_cnt_after_buy;
            $Merchandise->save();

            $total_price = $buy_cnt * $Merchandise->price;

            $transaction_data = [
                'user_id' => $Member->id,
                'merchandise_id' => $Merchandise->id,
                'price' => $Merchandise->price,
                'buy_count' => $buy_cnt,
                'total_price' => $total_price
            ];

            Transaction::create($transaction_data);

            DB::commit();

            $message = [
                'msg' => '購買成功'
            ];

            return redirect()->to('/merchandise/' . $Merchandise->id)->withErrors($message);


        } catch ( Exception $exception) {

            DB::rollBack();

            $error_message = [
                'msg' => [
                    $exception->getMessage(),
                ],
            ];

            return redirect()->back()->withErrors($error_message)->withInput();
        }
    }

}
