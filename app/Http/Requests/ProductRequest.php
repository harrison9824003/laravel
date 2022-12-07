<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('pj_product')->ignore($this->route('product')),
                'max:255'
            ],
            'price' => 'required|integer',
            'market_price' => 'nullable|integer',
            'simple_intro' => 'nullable|string|max:255',
            'intro' => 'required|string|max:2000',
            'part_number' => 'nullable|string|max:100',
            'start_date' => 'required|date_format:Y-m-d',
            'productImg.*' => 'mimes:jpg,jpeg,png|max:2000',
            'category_name_parent' => 'string',
            'category_parent' => 'integer',
            'category_name_childen' => 'string',
            'category_childen' => 'integer',
            'spec_parent_name.*' => 'string',
            'spec_parent.*' => 'integer',
            'spec_name_childen.*' => 'string',
            'spec_childen.*' => 'integer',
            'spec_reserve.*' => 'integer|min:1',
            'spec_low_reserve.*' => 'integer|min:1',
            'spec_volume.*' => 'string|max:100',
            'spec_weight.*' => 'string|max:100',
            'spec_order.*' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'productImg.*.mimes' => '僅能上傳格視為 jpg,jpeg,png 圖片',
            'productImg.*.max' => '圖片最大尺寸為 2MB',
            'category_name_parent.string' => '全站類別名稱須為文字',
            'category_parent.integer' => '全站類別id必須為數字',
            'category_name_childen.string' => '全站子類別名稱須為文字',
            'category_childen.integer' => '全站子類別id必須為數字',
            'spec_parent_name.*.string' => '規格分類名稱須為文字',
            'spec_parent.*.integer' => '規格分類id須為數字',
            'spec_name_childen.*.string' => '規格子分類名稱須為文字',
            'spec_childen.*.integer' => '規格子分類id須為數字',
            'spec_reserve.*.integer' => '庫存必須為數字',
            'spec_reserve.*.min' => '庫存數須大於等於 :min',
            'spec_low_reserve.*.integer' => '最小警告值須為數字',
            'spec_low_reserve.*.min' => '最小警告值須大於等於 :min',
            'spec_volume.*.string' => '材積須為數字',
            'spec_volume.*.max' => '材積值長度最大為 :max',
            'spec_weight.*.string' => '重量須為文字',
            'spec_weight.*.max' => '重量最大長度須為 :max',
            'spec_order.*.integer' => '排序值須為數字',
        ];
    }
}
