<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DataTypeFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datatypefolder = app(\App\Models\DataTypeFolder::class);
        $paginate = $datatypefolder->paginate(10);
        $binding = [
            'paginate' => $paginate
        ];
        return view('admin.pages.datatypefolder.list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datatype = app(\App\Models\DataType::class);
        $data = $datatype->where('disabled', '0')->where('folder_id', '0')->get();
        $binding = [
            'datatypes' => $data
        ];
        return view('admin.pages.datatypefolder.create', $binding);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name', 'datatype']);
        $rules = [
            'name' => 'required|unique:pj_datatype_folder,name|max:255',
            'datatype' => 'required'
        ];

        $column_name = [
            'name' => '分類名稱',
            'datatype' => 'models 模組'
        ];

        $validator = Validator::make($input, $rules, [], $column_name);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        $input['models'] = json_encode($input['datatype']);

        $datatypefolder = app(\App\Models\DataTypeFolder::class);
        $datatypefolder->create($input);
        $last_id = $datatypefolder->latest()->first()->id;

        $datatype = app(\App\Models\DataType::class);
        $datatype->whereIn('id', $input['datatype'])->update(['folder_id' => $last_id]);

        return redirect(route('datatypefolder.index'));
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
        $datatypefolder = app(\App\Models\DatatypeFolder::class);

        $data = $datatypefolder->findOrFail($id);
        $datatype = app(\App\Models\Datatype::class);
        $datatypes = json_decode($data->models, 1);
        $datatype_data = $datatype->where(function ($query) use ($datatypes) {
            $query->where('folder_id', '0')
                ->orWhereIn('id', $datatypes);
        })->get();

        $binding = [
            'datatypefolder' => $data,
            'datatypes' => $datatype_data,
            'datatypes_exists' => $datatypes
        ];

        return view('admin.pages.datatypefolder.edit', $binding);
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
        $input = $request->only(['name', 'datatype']);
        $rules = [
            'name' => [
                'required',
                Rule::unique('pj_datatype_folder')->ignore($id),
                'max:255'
            ],
            'datatype' => 'required'
        ];

        $column_name = [
            'name' => '分類名稱',
            'datatype' => 'models 模組'
        ];

        $validator = Validator::make($input, $rules, [], $column_name);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        $input['models'] = json_encode($input['datatype']);

        $datatypefolder = app(\App\Models\DataTypeFolder::class);
        $datatypefolder->findOrFail($id);

        $datatypefolder->name = $input['name'];
        $datatypefolder->models = $input['models'];
        $datatypefolder->save();

        $datatype = app(\App\Models\DataType::class);
        $datatype->where('folder_id', $id)->update(['folder_id' => '0']);
        $datatype->whereIn('id', $input['datatype'])->update(['folder_id' => $id]);

        return redirect(route('datatypefolder.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datatypefolder = app(\App\Models\DataTypeFolder::class);
        $object = $datatypefolder->findOrFail($id);
        $datatype = app(\App\Models\DataType::class);

        DB::transaction(function () use ($datatype, $object, $id) {
            $datatype->where('folder_id', $id)->update(['folder_id' => '0']);
            $object->delete();
        });

        return response()->json(['status' => '1', 'msg' => '刪除成功']);
    }
}
