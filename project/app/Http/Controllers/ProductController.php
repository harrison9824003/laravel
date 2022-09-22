<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        //
        $input = $request->all();
        $files = $request->file('productImg');

        $rules = [
            'name' => 'required|unique:pj_product|max:255',
            'price' => 'required|integer|max:6',
            'market_price' => 'nullable|integer|max:6',
            'simple_intro' => 'nullable|string|max:255',
            'intro' => 'required|string|max:2000',
            'part_number' => 'nullable|string|max:100',
            'start_date' => 'required|date_format:Y-m-d',
            'productImg.*' => 'mimes:jpg,jpeg,png|max:2000'
        ];

        $rule_text =[            
            'productImg.*.mimes' => 'Only jpg,jpeg,png images are allowed',
            'productImg.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ];

        
        $validator = Validator::make($input, $rules, $rule_text);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

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
}
