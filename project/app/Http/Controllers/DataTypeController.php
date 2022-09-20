<?php

namespace App\Http\Controllers;

use App\Models\DataType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DataTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datatype = app(DataType::class);
        $data = $datatype->paginate(10);
        $binding = [
            'paginate' => $data
        ];

        return view('admin.pages.datatype.list', $binding);
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
        $datatype = app(Datatype::class);
        $data = $datatype->findOrFail($id);
        $binding = [
            'datatype' => $data
        ];

        return view('admin.pages.datatype.edit', $binding);
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
        $input = $request->only(['name', 'icon', 'disabled']);
        $rules = [
            'name' => [
                'required', 
                Rule::unique('pj_data_type')->ignore($id), 
                'max:255'
            ],
            'icon' => 'nullable|string',
            'disabled' => 'nullable|boolean',
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput($input);
        }

        $datatype = app(DataType::class);
        $data = $datatype->findOrFail($id);

        $data->name = $input['name'];
        $data->icon = $input['icon'] != '' ? $input['icon'] : 'bx-note';
        $data->disabled = ( isset($input['disabled']) && $input['disabled'] == '1' ) ? '1' : '0';

        $data->update();

        return redirect()->route('datatype.edit', ['datatype' => $id ]);        
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
