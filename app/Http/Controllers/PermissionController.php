<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model_id = request()->input('datatype');
        $permission = app(Permission::class);
        return view('admin.pages.permission.list', [
            'paginate' => $permission
                ->where('model_id', $model_id)
                ->paginate(10),
            'model_id' => $model_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'admin.pages.permission.create',
            [
                'model_id' => request()->input('datatype')
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['function', 'name', 'description', 'model_id']);

        $rules = [
            'name' => [
                'required',
                'max:255'
            ],
            'name' => 'required|string',
            'description' => 'nullable|string',
            'model_id' => [
                'required',
                'exists:App\Models\DataType,id'
            ],
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        Permission::create($input);

        return redirect()->route('permission.index', ['datatype' => $request->input('model_id') ]);
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
        $permission = Permission::findOrFail($id);
        return view('admin.pages.permission.edit', [
            'permission' => $permission
        ]);
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
        $input = $request->only(['function', 'name', 'description']);

        $rules = [
            'name' => [
                'required',
                'max:255'
            ],
            'name' => 'required|string',
            'description' => 'nullable|string',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($input);
        }

        $permission = Permission::findOrFail($id);
        $permission->update($input);

        return redirect()->route('permission.index', ['datatype' => $request->input('model_id') ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(['status' => '1', 'msg' => '刪除成功']);
    }
}
