<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

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
    public function store(ProductRequest $request)
    {
        $input = $request->all();
        $files = $request->file('productImg');

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

        if (!isset($p_input['market_price']) || empty($p_input['market_price'])) {
            $p_input['market_price'] = 0;
        }

        if (!isset($p_input['simple_intro']) || empty($p_input['simple_intro'])) {
            $p_input['simple_intro'] = '';
        }

        if (!isset($p_input['simple_intro']) || empty($p_input['simple_intro'])) {
            $p_input['part_number'] = '';
        }

        $p_input['end_date'] = '2035-12-31';

        $product = \App\Models\Shop\Product::create($p_input);
        $product_id = $product->id;

        $p_class = app(\App\Models\Shop\Product::class);

        // 商品圖片
        if (is_array($files) && count($files) > 0) {

            foreach ($files as $file) {

                $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                $img_input = [
                    'data_id' => $p_class->get_model_id(),
                    'item_id' => $product_id,
                    'path' => $path,
                    'data_type' => $file->getClientMimeType(),
                    'description' => $file->getClientOriginalName()
                ];
                $product_img  = \App\Models\Shop\ProductImage::create($img_input);
            }
        }


        // 規格
        //$p_spec = app(\App\Models\Shop\ProductSpec::class);
        foreach ($input['spec_parent_name'] as $k => $spec_name) {

            $spec_input = [
                'category_id' => $input["spec_childen"][$k],
                'product_id' => $product_id,
                'reserve_num' => $input["spec_reserve"][$k],
                'low_reserve_num' => $input["spec_low_reserve"][$k],
                'volume' => $input["spec_volume"][$k],
                'weight' => $input["spec_weight"][$k],
                'order' => $input["spec_order"][$k]
            ];

            $p_spec = \App\Models\Shop\ProductSpec::create($spec_input);
        }

        // 全站分類
        $category_input = [
            'data_id' => $p_class->get_model_id(),
            'category_id' => $input['category_childen'],
            'item_id' => $product_id
        ];

        $category = \App\Models\RelationShipCatory::create($category_input);

        return redirect()->route('product.index');
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
        $product = app(\App\Models\Shop\Product::class);
        $p_image = app(\App\Models\Shop\ProductImage::class);
        $p_spec = app(\App\Models\Shop\ProductSpec::class);
        $r_category = app(\App\Models\RelationShipCatory::class);

        // 全站分類
        $category = app(\App\Models\Categroy::class);

        // 規格
        $spec = app(\App\Models\Shop\SpecCategory::class);

        $binding = [
            'product' => $product->findOrFail($id),
            'p_images' => $p_image->where('item_id', $id)->where('data_id', $product->get_model_id())->get(),
            'p_specs' => $p_spec->where('product_id', $id)->get(),
            'r_category' => $r_category->where('item_id', $id)->where('data_id', $product->get_model_id())->first(),
            'category_parent' => $category->where('parent_id', '0')->get(),
            'spec_parent' => $spec->where('parent_id', '0')->get()
        ];

        return view('admin.pages.product.edit', $binding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $input = $request->all();
        $files = $request->file('productImg');

        // 商品基本資料
        $p_input = $request->safe()->only([
            'name',
            'price',
            'market_price',
            'simple_intro',
            'intro',
            'part_number',
            'start_date'
        ]);


        if (!isset($p_input['market_price']) || empty($p_input['market_price'])) {
            $p_input['market_price'] = 0;
        }

        if (!isset($p_input['simple_intro']) || empty($p_input['simple_intro'])) {
            $p_input['simple_intro'] = '';
        }

        if (!isset($p_input['simple_intro']) || empty($p_input['simple_intro'])) {
            $p_input['part_number'] = '';
        }

        $p_input['end_date'] = '2035-12-31';
        $product = app(\App\Models\Shop\Product::class);
        $product = $product->findOrFail($id);
        $product_id = $product->id;
        $product->update($p_input);

        $p_class = app(\App\Models\Shop\Product::class);

        // 商品圖片
        if (is_array($files) && count($files) > 0) {

            foreach ($files as $file) {

                $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                $img_input = [
                    'data_id' => $p_class->get_model_id(),
                    'item_id' => $product_id,
                    'path' => $path,
                    'data_type' => $file->getClientMimeType(),
                    'description' => $file->getClientOriginalName()
                ];
                $product_img  = \App\Models\Shop\ProductImage::create($img_input);
            }
        }

        // 規格
        //$p_spec = app(\App\Models\Shop\ProductSpec::class);
        foreach ($input['spec_parent_name'] as $k => $spec_name) {

            $spec_input = [
                'category_id' => $input["spec_childen"][$k],
                'product_id' => $product_id,
                'reserve_num' => $input["spec_reserve"][$k],
                'low_reserve_num' => $input["spec_low_reserve"][$k],
                'volume' => $input["spec_volume"][$k],
                'weight' => $input["spec_weight"][$k],
                'order' => $input["spec_order"][$k]
            ];

            $p_spec = app(\App\Models\Shop\ProductSpec::class);
            if ($input["spec_id"][$k] == '0') {
                $p_spec->create($spec_input);
            } else {
                $obj = $p_spec->findOrFail($input["spec_id"][$k]);
                $obj->update($spec_input);
            }
        }

        // 全站分類
        $category_input = [
            'data_id' => $p_class->get_model_id(),
            'category_id' => $input['category_childen'],
            'item_id' => $product_id
        ];

        $category = app(\App\Models\RelationShipCatory::class);
        $obj = $category->findOrFail($input['category_id']);
        $obj->update($category_input);

        return redirect()->route('product.edit', ['product' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::transaction(function () use ($id) {

                $product = app(\App\Models\Shop\Product::class);
                $p_image = app(\App\Models\Shop\ProductImage::class);
                $p_spec = app(\App\Models\Shop\ProductSpec::class);
                $r_category = app(\App\Models\RelationShipCatory::class);

                // 商品資料刪除
                $product->where('id', $id)->delete();

                // 圖片資料
                $images = $p_image->where('item_id', $id)->where('data_id', $product->get_model_id())->get();
                $d_image = [];
                foreach ($images as $k => $image) {
                    $d_image[] = public_path($image->path);
                    $image->delete();
                }

                // 規格
                $p_spec->where('product_id', $id)->delete();

                // 全站分類
                $r_category->where('item_id', $id)->where('data_id', $product->get_model_id())->delete();

                // 圖片檔案刪除
                foreach ($d_image as $k => $path) {
                    @unlink(public_path($path));
                }
            });

        } catch (Exception $e) {

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => 0
            ]);

        }

        return response()->json(['status' => '1', 'msg' => '刪除成功']);
    }

    public function get_childen_spec($id)
    {

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

    public function delete_spec($id)
    {
        if (empty($id)) {
            return response()->json([
                'data' => [],
                'error' => 'empyt id value',
                'status' => 0
            ]);
        }

        $spec = app(\App\Models\Shop\ProductSpec::class);
        $data = $spec->findOrFail($id);
        $data->delete();

        return response()->json([
            'data' => [],
            'msg' => '刪除成功!',
            'status' => 1
        ]);
    }
}
