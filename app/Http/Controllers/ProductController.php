<?php

namespace App\Http\Controllers;

use App\Events\DeleteProduct;
use App\Http\Requests\ProductRequest;
use App\Mail\ProductCreate;
use App\Mail\ProductUpdate;
use App\Models\RelationShipCatory;
use App\Models\Shop\ProductImage;
use App\Models\Shop\ProductSpec;
use App\Models\Shop\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private Product $product,
        private ProductSpec $productSpec,
        private ProductImage $productImage,
        private Redis $redis,
    )
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = app(Product::class);
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
        $category = app(\App\Models\Category::class);
        $data = $category->where('parent_id', '0')->get();

        // 規格
        $spec = app(\App\Models\Shop\SpecCategory::class);
        $specData = $spec->where('parent_id', '0')->get();

        $binding = [
            'category_parent' => $data,
            'spec_parent' => $specData
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
        $productInput = $request->only([
            'name',
            'price',
            'market_price',
            'simple_intro',
            'intro',
            'part_number',
            'start_date'
        ]);

        if (!isset($productInput['market_price']) || empty($productInput['market_price'])) {
            $productInput['market_price'] = 0;
        }

        if (!isset($productInput['simple_intro']) || empty($productInput['simple_intro'])) {
            $productInput['simple_intro'] = '';
        }

        if (!isset($productInput['simple_intro']) || empty($productInput['simple_intro'])) {
            $productInput['part_number'] = '';
        }

        $productInput['end_date'] = '2035-12-31';

        $productInput['user_id'] = auth()->id();

        DB::beginTransaction();
        try {
            $product = Product::create($productInput);
            $product_id = $product->id;

            $productClass = app(Product::class);

            // 商品圖片
            if (is_array($files) && count($files) > 0) {
                foreach ($files as $file) {
                    $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                    $imgInput = [
                        'data_id' => $productClass->getModelId(),
                        'item_id' => $product_id,
                        'path' => $path,
                        'data_type' => $file->getClientMimeType(),
                        'description' => $file->getClientOriginalName()
                    ];
                    productImage::create($imgInput);
                }
            }

            // 規格
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

                ProductSpec::create($spec_input);
            }

            // 全站分類
            $category_input = [
                'data_id' => $productClass->getModelId(),
                'category_id' => $input['category_childen'],
                'item_id' => $product_id
            ];

            RelationShipCatory::create($category_input);

            DB::commit();

            cache()->set('product_'.$product_id, $product->toJson());
        } catch (Exception $e) {
            $errors = ['database_error' => $e->getMessage()];
            DB::rollBack();
        }
        Mail::to(auth()->user())->send(new ProductCreate($product));

        return redirect()->route('product.index')->withErrors($errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = app(Product::class);
        $pImage = app(ProductImage::class);
        $pSpec = app(ProductSpec::class);
        $rCategory = app(RelationShipCatory::class);

        // 全站分類
        $category = app(\App\Models\Category::class);

        // 規格
        $spec = app(\App\Models\Shop\SpecCategory::class);

        $productObj = $product->findOrFail($id);

        $this->authorize('update-product', $productObj);

        $binding = [
            'product' => $productObj,
            'p_images' => $pImage->where('item_id', $id)->where('data_id', $product->getModelId())->get(),
            'p_specs' => $pSpec->where('product_id', $id)->get(),
            'r_category' => $rCategory->where('item_id', $id)->where('data_id', $product->getModelId())->first(),
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
        $pInput = $request->safe()->only([
            'name',
            'price',
            'market_price',
            'simple_intro',
            'intro',
            'part_number',
            'start_date'
        ]);


        if (!isset($pInput['market_price']) || empty($pInput['market_price'])) {
            $pInput['market_price'] = 0;
        }

        if (!isset($pInput['simple_intro']) || empty($pInput['simple_intro'])) {
            $pInput['simple_intro'] = '';
        }

        if (!isset($pInput['simple_intro']) || empty($pInput['simple_intro'])) {
            $pInput['part_number'] = '';
        }

        $pInput['end_date'] = '2035-12-31';
        $pInput['user_id'] = auth()->id();

        DB::beginTransaction();
        try {

            $product = app(Product::class);
            $product = $product->findOrFail($id);
            $product_id = $product->id;
            $product->update($pInput);

            $productClass = app(Product::class);

            // 商品圖片
            if (is_array($files) && count($files) > 0) {
                foreach ($files as $file) {
                    $path = $file->storeAs('images', md5(time()) . "." . $file->extension(), 'uploads');

                    $img_input = [
                        'data_id' => $productClass->getModelId(),
                        'item_id' => $product_id,
                        'path' => $path,
                        'data_type' => $file->getClientMimeType(),
                        'description' => $file->getClientOriginalName()
                    ];
                    ProductImage::create($img_input);
                }
            }

            // 規格
            //$pSpec = app(ProductSpec::class);
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

                $pSpec = app(ProductSpec::class);
                if ($input["spec_id"][$k] == '0') {
                    $pSpec->create($spec_input);
                } else {
                    $obj = $pSpec->findOrFail($input["spec_id"][$k]);
                    $obj->update($spec_input);
                }
            }

            // 全站分類
            $category_input = [
                'data_id' => $productClass->getModelId(),
                'category_id' => $input['category_childen'],
                'item_id' => $product_id
            ];

            $category = app(RelationShipCatory::class);
            $obj = $category->findOrFail($input['category_id']);
            $obj->update($category_input);

            cache()->set('product_'.$product_id, $product->toJson());
            Mail::to(auth()->user())->later(60, new ProductUpdate($product));

            DB::commit();
        } catch (Exception) {
            DB::rollBack();
        }

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

                $product = app(Product::class);
                $pImage = app(ProductImage::class);
                $pSpec = app(ProductSpec::class);
                $rCategory = app(RelationShipCatory::class);

                // 商品資料刪除
                $data = $product->findOrFail($id);
                $data->delete();

                // 圖片資料
                $images = $pImage->where('item_id', $id)->where('data_id', $product->getModelId())->get();
                $d_image = [];
                foreach ($images as $k => $image) {
                    $d_image[] = public_path($image->path);
                    $image->delete();
                }

                // 規格
                $pSpec->where('product_id', $id)->delete();

                // 全站分類
                $rCategory->where('item_id', $id)->where('data_id', $product->getModelId())->delete();

                // 圖片檔案刪除
                foreach ($d_image as $k => $path) {
                    @unlink(public_path($path));
                }

                event(new DeleteProduct(auth()->user(), $data));
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

    public function getChildenSpec($id)
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

    public function deleteSpec($id)
    {
        if (empty($id)) {
            return response()->json([
                'data' => [],
                'error' => 'empyt id value',
                'status' => 0
            ]);
        }

        $spec = app(ProductSpec::class);
        $data = $spec->findOrFail($id);
        $data->delete();

        return response()->json([
            'data' => [],
            'msg' => '刪除成功!',
            'status' => 1
        ]);
    }
}
