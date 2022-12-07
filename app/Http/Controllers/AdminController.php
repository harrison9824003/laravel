<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    // 刪除全站圖片
    public function deleteImg($id)
    {
        if (empty($id)) {
            return response()->json([
                'data' => [],
                'error' => 'empyt id value',
                'status' => 0
            ]);
        }

        $image = app(\App\Models\Shop\ProductImage::class);
        $data = $image->findOrFail($id);
        $path = $data->path;
        $data->delete();
        @unlink($path);

        return response()->json([
            'data' => [],
            'msg' => '刪除成功!',
            'status' => 1
        ]);
    }
}
