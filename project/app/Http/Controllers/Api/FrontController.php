<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FrontResource;

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
        $m_object = new $d_object->class_name;
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

    public function category($id){

        // 模組與資料的關係表
        $relation = app(\App\Models\RelationShipCatory::class);
        $r_object = $relation->where('category_id', $id)->paginate($this->page_count);
        
        // 模組
        $subset = $r_object->groupBy('data_id');
        
        $datetype = app(\App\Models\DataType::class);
        foreach($subset as $model_id => $items ) {            
            
            $d_object = $datetype->findOrFail($model_id);

            // 建立 eloquent
            $m_object = new $d_object->class_name;
            // 取出所有資料 id
            $datas_id = array_column($items->toArray(), 'item_id');
            $datas = $m_object->whereIn('id', $datas_id)->get(); 
            // 將 key 改為資料的 id   
            $datas = $datas->keyBy('id');
            
            // 依序回填到 $r_object 物件內
            foreach ( $items as $key => $item ) {                
                $item->front = new FrontResource($datas[$item->item_id]);
            }

        }
        
        return response()->json($r_object);
    }
}
