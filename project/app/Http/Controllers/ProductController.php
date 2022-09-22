<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = app(\App\Models\Shop\Product::class);
        $paginate = $products->paginate(10); 
        $binding = [
            'paginate' => $paginate
        ];   
        return view('admin.pages.product.list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 全站分類
        $category = app(\App\Models\Categroy::class);
        $data = $category->where('parent_id', '0')->get();

        // 規格
        $spec = app(\App\Models\Shop\SpecCategory::class);
        $spec_data = $spec->where('parent_id', '0')->get();

        $binding = [
            'category_parent' => $data,
            'spec_parent' => $spec_data
        ];
        return view('admin.pages.product.create', $binding);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $files = $request->file('productImg');
        
        $rules = [
            'name' => 'required|unique:pj_product|max:255',
            'price' => 'required|integer',
            'market_price' => 'nullable|integer',
            'simple_intro' => 'nullable|string|max:255',
            'intro' => 'required|string|max:2000',
            'part_number' => 'nullable|string|max:100',
            'start_date' => 'required|date_format:Y-m-d',
            'productImg.*' => 'mimes:jpg,jpeg,png|max:2000',
            'category_name_parent' => 'string',
            'category_parent' => 'integer',
            'category_name_childen' => 'string',
            'category_childen' => 'integer',
            'spec_parent_name.*' => 'string',
            'spec_parent.*' => 'integer',
            'spec_name_childen.*' => 'string',
            'spec_childen.*' => 'integer',
            'spec_reserve.*' => 'integer|min:1',
            'spec_low_reserve.*' => 'integer|min:1',
            'spec_volume.*' => 'string|max:100',
            'spec_weight.*' => 'string|max:100',
            'spec_order.*' => 'integer',
        ];

        $rule_text =[            
            'productImg.*.mimes' => '僅能上傳格視為 jpg,jpeg,png 圖片',
            'productImg.*.max' => '圖片最大尺寸為 2MB',
            'category_name_parent.string' => '全站類別名稱須為文字',
            'category_parent.integer' => '全站類別id必須為數字',
            'category_name_childen.string' => '全站子類別名稱須為文字',
            'category_childen.integer' => '全站子類別id必須為數字',
            'spec_parent_name.*.string' => '規格分類名稱須為文字',
            'spec_parent.*.integer' => '規格分類id須為數字',
            'spec_name_childen.*.string' => '規格子分類名稱須為文字',
            'spec_childen.*.integer' => '規格子分類id須為數字',
            'spec_reserve.*.integer' => '庫存必須為數字',
            'spec_reserve.*.min' => '庫存數須大於等於 :min',
            'spec_low_reserve.*.integer' => '最小警告值須為數字',
            'spec_low_reserve.*.min' => '最小警告值須大於等於 :min',
            'spec_volume.*.string' => '材積須為數字',
            'spec_volume.*.max' => '材積值長度最大為 :max',
            'spec_weight.*.string' => '重量須為文字',
            'spec_weight.*.max' => '重量最大長度須為 :max',
            'spec_order.*.integer' => '排序值須為數字',
        ];
        
        $validator = Validator::make($input, $rules, $rule_text);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        // 商品基本資料
        $p_input = $request->only([
            'name',
            'price',
            'market_price',
            'simple_intro',
            'intro',
            'part_number',
            'start_date'
        ]);
        $product = \App\Models\Shop\Product::create($p_input);
        print_r($product);exit;
        

        echo "<pre>";
        var_dump($request->hasFile('productImg'));
        print_r($input);
        print_r($files);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_childen_spec($id) {        

        try {

            $spec = app(\App\Models\Shop\SpecCategory::class);
            $data = $spec->select(['id', 'name', 'parent_id'])->where('parent_id', $id)->get();

        } catch (Exception $e) {

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => 0
            ]);
            
        }        

        return response()->json([
            'data' => $data,
            'status' => 1
        ]);
    }
}
