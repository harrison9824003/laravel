<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = app(\App\Models\Categroy::class);
        $paginate = $category->paginate(10); 
        $binding = [
            'paginate' => $paginate
        ];
        return view('admin.pages.category.list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = app(\App\Models\Categroy::class);  
        $parent_category = $category->where('parent_id', '0')->get();
        $category->refresh();

        $binding = [
            'parent_category' => $parent_category
        ];
        return view('admin.pages.category.create', $binding);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name', 'parent_id']);
        $rules = [
            'name' => 'required|unique:pj_category,name|max:255',
            'parent_id' => 'nullable|integer',
        ];

        $column_name = [
            'name' => '類別名稱',
            'parent_id' => '父階層',
        ];

        $validator = Validator::make($input, $rules, [], $column_name);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        if ( !isset($input['parent_id']) || empty($input['parent_id']) ) {
            $input['parent_id'] = 0;
        }

        $input['order'] = 0;

        $category = app(\App\Models\Categroy::class);        
        $category->create($input);

        return redirect(route('category.index'));
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
        $category = app(\App\Models\Categroy::class);  
        $parent_category = $category->where('parent_id', '0')->where('id', '!=', $id)->get();
        $category->refresh();

        $current_category = $category->findOrFail($id);
        $parent_name = '';

        if( $current_category->parent_id != '0' ) {
            $parent = $parent_category->filter(function($value, $key) use($current_category) {
                return ( $value->id == $current_category->parent_id);
            });            
            $parent_name = $parent->first()->name;
        }        

        $binding = [
            'category' => $current_category,
            'parent_category' => $parent_category,
            'parent_name' => $parent_name
        ];  
        return view('admin.pages.category.edit', $binding);
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
        $input = $request->only(['name', 'parent_id', 'order']);
        $rules = [
            'name' => [
                'required', 
                Rule::unique('pj_category')->ignore($id), 
                'max:255'
            ],
            'parent_id' => 'nullable|integer',
            'order' => 'nullable|integer',
        ];

        $column_name = [
            'name' => '類別名稱',
            'parent_id' => '父階層',
            'order' => '排序'
        ];

        $validator = Validator::make($input, $rules, [], $column_name);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        if ( !isset($input['parent_id']) || empty($input['parent_id']) ) {
            $input['parent_id'] = 0;
        }

        if ( !isset($input['order']) || empty($input['order']) ) {
            $input['order'] = 0;
        }

        $category = app(\App\Models\Categroy::class);        
        $object = $category->findOrFail($id);
        $object->name = $input['name'];
        $object->parent_id = $input['parent_id'];
        $object->order = $input['order'];
        $object->update();

        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = app(\App\Models\Categroy::class);
        $object = $category->findOrFail($id);
        $object->delete();

        return response()->json(['status' => '1', 'msg' => '刪除成功']);
    }

    public function get_childen_category($id)
    {
        try {

            $category = app(\App\Models\Categroy::class);
            $data = $category->select(['id', 'name', 'parent_id'])
                            ->where('parent_id', $id)
                            ->orderBy('order')->get();

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
