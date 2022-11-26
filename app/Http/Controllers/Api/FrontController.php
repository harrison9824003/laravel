<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FrontResource;
use App\Models\Category;
use App\Models\Shop\Cart;
use App\Models\Shop\ProductSpec;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class FrontController extends Controller
{
    // 列表頁顯示筆數
    protected $page_count = 15;

    // 小區塊顯示筆數
    protected $block_count = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 模組與資料的關係表
        $relation = app(\App\Models\RelationShipCatory::class);
        $r_object = $relation->findOrFail($id);

        // 在關係表中查到該筆資料屬於哪一個模組
        $datetype = app(\App\Models\DataType::class);
        $d_object = $datetype->findOrFail($r_object->data_id);

        // 建立 eloquent
        $m_object = new $d_object->class_name();
        $data = $m_object->findOrFail($r_object->item_id);

        return new FrontResource($data);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function category($id)
    {
        $category = Category::FindOrFail($id);
        // 模組與資料的關係表
        $relation = app(\App\Models\RelationShipCatory::class);

        if ($category->parent_id === 0) {

            $sub = Category::where('parent_id', $id)->pluck('id');
            $r_object = $relation->whereIn('category_id', $sub)->paginate($this->page_count);
        } else {
            $r_object = $relation->where('category_id', $id)->paginate($this->page_count);
        }


        // 模組
        $subset = $r_object->groupBy('data_id');

        $datetype = app(\App\Models\DataType::class);
        foreach ($subset as $model_id => $items) {
            $d_object = $datetype->findOrFail($model_id);

            // 建立 eloquent
            $m_object = new $d_object->class_name();
            // 取出所有資料 id
            $datas_id = array_column($items->toArray(), 'item_id');
            $datas = $m_object->whereIn('id', $datas_id)->get();
            // 將 key 改為資料的 id
            $datas = $datas->keyBy('id');

            // 依序回填到 $r_object 物件內
            foreach ($items as $item) {
                $item->front = new FrontResource($datas[$item->item_id]);
            }
        }

        return response()->json($r_object);
    }

    public function mainMenu()
    {

        $category = app(\App\Models\Category::class);
        $data = $category->select(['id', 'parent_id', 'name', 'order', 'display'])
            ->where('display', '1')->where('parent_id', '0')
            ->orderBy('order')->get();

        $menu = [];
        foreach ($data as $k => $c) {
            // 父類別
            $menu[$k] = $c;

            // 子類別
            if ($category->where('parent_id', $c->id)->where('display', '1')->count() > 0) {
                $childens = [];
                $childen = $category->select(['id', 'parent_id', 'name', 'order', 'display'])
                    ->where('parent_id', $c->id)
                    ->where('display', '1')->orderBy('order')->get();
                foreach ($childen as $c_k => $c_c) {
                    $childens[] = $c_c;
                }
                $menu[$k]->childen = $childens;
                $menu[$k]->childen_cnt = count($childens);
            }
        }

        $state = 0;
        if (count($menu)) {
            $state = 1;
        }

        return response()->json(['data' => $menu, 'state' => $state]);
    }

    public function cart(): JsonResponse
    {
        $product_id = request()->input('product_id');
        $spec_id = request()->input('spec_id');
        $number = request()->input('number');

        // 取的 user id
        $sessionID = session()->getId();

        // product spec 資訊
        $productSpecInfo = ProductSpec::cart($product_id, $spec_id)->get()->first();
        if($productSpecInfo === null){
            throw new Exception();
        }
        try{
            $cart = Cart::where('user_id', $sessionID)->firstOrFail();
            $cartInfo = collect(json_decode($cart->cart, 1));
        } catch (ModelNotFoundException) {
            $cartInfo = collect();
            $cart = Cart::create([
                'user_id' => $sessionID,
                'cart' => ''
            ]);
        }

        // 是否有在購物車內
        $productCartInfo = $cartInfo->get($product_id, []);

        $totalCartNumber = 0;
        if(isset($productCartInfo[$spec_id])){
            $productCartInfo[$spec_id]['number'] += $number;
        } else {
            $productCartInfo[$spec_id]['number'] = $number;
        }

        if($productSpecInfo->reserve_num >= $totalCartNumber) {
            
            $cartInfo->put($product_id, $productCartInfo);
        }

        // $cart->cart = json_encode($cartInfo->toArray());
        $cart->where('user_id', $sessionID)->update([
            'cart' => json_encode($cartInfo->toArray())
        ]);

        return response()->json([
            'status' => '1',
            'msg' => '商品成功加入購物車',
            'cart' => $cartInfo->toArray()
        ]);
    }
}
