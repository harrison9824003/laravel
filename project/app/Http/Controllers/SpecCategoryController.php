<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SpecCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spec_category = app(\App\Models\Shop\SpecCategory::class);
        $paginate = $spec_category->paginate(10);        
        $binding = [
            'paginate' => $paginate
        ];

        return view('admin.pages.product.spec_list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spec_category = app(\App\Models\Shop\SpecCategory::class);  
        $parent_category = $spec_category->where('parent_id', '0')->get();
        $spec_category->refresh();

        $binding = [
            'parent_category' => $parent_category
        ];
        return view('admin.pages.product.spec_create', $binding);
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
            'name' => 'required|unique:pj_spec_category,name|max:255',
            'parent_id' => 'nullable|integer',
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        if ( !isset($input['parent_id']) || empty($input['parent_id']) ) {
            $input['parent_id'] = 0;
        }

        $spec_category = app(\App\Models\Shop\SpecCategory::class);        
        $spec_category->create($input);

        return redirect(route('spec.index'));

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
        $spec_category = app(\App\Models\Shop\SpecCategory::class);  
        $parent_category = $spec_category->where('parent_id', '0')->where('id', '!=', $id)->get();
        $spec_category->refresh();

        $current_spec = $spec_category->findOrFail($id);
        $parent_name = '';

        if( $current_spec->parent_id != '0' ) {
            $parent = $parent_category->filter(function($value, $key) use($current_spec) {
                return ( $value->id == $current_spec->parent_id);
            });            
            $parent_name = $parent->first()->name;
        }        

        $binding = [
            'spec_category' => $current_spec,
            'parent_category' => $parent_category,
            'parent_name' => $parent_name
        ];  
        return view('admin.pages.product.spec_edit', $binding);
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
        $input = $request->only(['name', 'parent_id']);

        $spec_category = app(\App\Models\Shop\SpecCategory::class);        
        $spec_category = $spec_category->find($id);
        
        $rules = [
            'name' => [
                'required', 
                Rule::unique('pj_spec_category')->ignore($id), 
                'max:255'
            ],
            'parent_id' => 'nullable|integer',
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        if ( !isset($input['parent_id']) || empty($input['parent_id']) ) {
            $input['parent_id'] = 0;
        }

        
        $spec_category->name = $input['name'];
        $spec_category->parent_id = $input['parent_id'];
        
        $spec_category->save();

        return redirect(route('spec.edit', ['spec' => $id]));
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
        $spec_category = app(\App\Models\Shop\SpecCategory::class);
        $spec_category = $spec_category->findOrFail($id);
        $spec_category->delete();

        return response()->json(['status' => '1', 'msg' => '刪除成功']);
    }
}
