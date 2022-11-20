<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = app(\App\Models\Article::class);
        $paginate = $article->paginate(10);
        $binding = [
            'paginate' => $paginate
        ];
        return view('admin.pages.article.list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 全站分類
        $category = app(\App\Models\Category::class);
        $data = $category->where('parent_id', '0')->get();

        $binding = [
            'category_parent' => $data,
        ];
        return view('admin.pages.article.create', $binding);
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
        $files = $request->file('articleImg');

        $rules = [
            'title' => 'required|unique:pj_article|max:255',
            'sub_title' => 'nullable|max:255',
            'content' => 'required|string|max:2000',
            'start_date' => 'required|date_format:Y-m-d',
            'articleImg.*' => 'mimes:jpg,jpeg,png|max:2000',
            'category_name_parent' => 'string',
            'category_parent' => 'integer',
            'category_name_childen' => 'string',
            'category_childen' => 'integer',
        ];

        $rule_text = [
            'articleImg.*.mimes' => '僅能上傳格視為 jpg,jpeg,png 圖片',
            'articleImg.*.max' => '圖片最大尺寸為 2MB',
            'category_name_parent.string' => '全站類別名稱須為文字',
            'category_parent.integer' => '全站類別id必須為數字',
            'category_name_childen.string' => '全站子類別名稱須為文字',
            'category_childen.integer' => '全站子類別id必須為數字',
        ];

        $validator = Validator::make($input, $rules, $rule_text);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        // 文章新增
        $a_input = $request->only([
            'title',
            'sub_title',
            'content',
            'start_date'
        ]);

        if (isset($input['is_active'])) {
            $a_input['end_date'] = '2035-12-31';
        } else {
            $a_input['end_date'] = date("Y-m-d", strtotime("-1 days"));
        }

        $a_input['is_active'] = $input['is_active'] ?? 0;

        $article = \App\Models\Article::create($a_input);
        $article_id = $article->id;

        $a_class = app(\App\Models\Article::class);

        // 商品圖片
        if (is_array($files) && count($files) > 0) {
            foreach ($files as $file) {
                $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                $img_input = [
                    'data_id' => $a_class->getModelId(),
                    'item_id' => $article_id,
                    'path' => $path,
                    'data_type' => $file->getClientMimeType(),
                    'description' => $file->getClientOriginalName()
                ];
                $product_img  = \App\Models\Shop\ProductImage::create($img_input);
            }
        }

        // 全站分類
        $category_input = [
            'data_id' => $a_class->getModelId(),
            'category_id' => $input['category_childen'],
            'item_id' => $article_id
        ];

        $category = \App\Models\RelationShipCatory::create($category_input);

        return redirect()->route('article.index');
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
        $article = app(\App\Models\Article::class);
        $a_image = app(\App\Models\Shop\ProductImage::class);
        $r_category = app(\App\Models\RelationShipCatory::class);

        // 全站分類
        $category = app(\App\Models\Category::class);


        $binding = [
            'article' => $article->findOrFail($id),
            'a_images' => $a_image->where('item_id', $id)->where('data_id', $article->getModelId())->get(),
            'r_category' => $r_category->where('item_id', $id)->where('data_id', $article->getModelId())->first(),
            'category_parent' => $category->where('parent_id', '0')->get()
        ];

        return view('admin.pages.article.edit', $binding);
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
        $input = $request->all();
        $files = $request->file('articleImg');

        $rules = [
            'title' => [
                'required',
                Rule::unique('pj_article')->ignore($id),
                'max:255'
            ],
            'sub_title' => 'nullable|max:255',
            'content' => 'required|string|max:2000',
            'start_date' => 'required|date_format:Y-m-d',
            'articleImg.*' => 'mimes:jpg,jpeg,png|max:2000',
            'category_name_parent' => 'string',
            'category_parent' => 'integer',
            'category_name_childen' => 'string',
            'category_childen' => 'integer',
        ];

        $rule_text = [
            'articleImg.*.mimes' => '僅能上傳格視為 jpg,jpeg,png 圖片',
            'articleImg.*.max' => '圖片最大尺寸為 2MB',
            'category_name_parent.string' => '全站類別名稱須為文字',
            'category_parent.integer' => '全站類別id必須為數字',
            'category_name_childen.string' => '全站子類別名稱須為文字',
            'category_childen.integer' => '全站子類別id必須為數字',
        ];

        $validator = Validator::make($input, $rules, $rule_text);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        // 文章新增
        $a_input = $request->only([
            'title',
            'sub_title',
            'content',
            'start_date'
        ]);

        if (isset($input['is_active'])) {
            $a_input['end_date'] = '2035-12-31';
        } else {
            $a_input['end_date'] = date("Y-m-d", strtotime("-1 days"));
        }

        $a_input['is_active'] = $input['is_active'] ?? 0;

        $a_class = app(\App\Models\Article::class);
        $article = $a_class->findOrFail($id);
        $article_id = $article->id;
        $article->update($a_input);


        // 商品圖片
        if (is_array($files) && count($files) > 0) {
            foreach ($files as $file) {
                $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                $img_input = [
                    'data_id' => $a_class->getModelId(),
                    'item_id' => $article_id,
                    'path' => $path,
                    'data_type' => $file->getClientMimeType(),
                    'description' => $file->getClientOriginalName()
                ];
                $product_img  = \App\Models\Shop\ProductImage::create($img_input);
            }
        }

        // 全站分類
        $category_input = [
            'data_id' => $a_class->getModelId(),
            'category_id' => $input['category_childen'],
            'item_id' => $article_id
        ];

        $category = app(\App\Models\RelationShipCatory::class);
        $obj = $category->findOrFail($input['category_id']);
        $obj->update($category_input);

        return redirect()->route('article.edit', ['article' => $id]);
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
