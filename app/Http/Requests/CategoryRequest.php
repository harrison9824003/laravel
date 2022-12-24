<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
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
                Rule::unique('pj_category')->ignore($this->input('id')),
                'max:255'
            ],
            'parent_id' => 'nullable|integer',
            'order' => 'nullable|integer',
            'display' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '類別名稱',
            'parent_id' => '父階層',
            'order' => '排序',
            'display' => '是否顯示於前台選單'
        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'name' => trim($this->name),
        ]);
    }
}
