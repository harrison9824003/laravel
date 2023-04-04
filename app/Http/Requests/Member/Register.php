<?php

namespace App\Http\Requests\Member;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Register extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => [
                'string',
                'max:1'
            ],
            'lastname' => [
                'string',
                'max:2'
            ],
            'email' => [
                'string',
                'email',
                'required'
            ],
            'account' => [
                'string',
                'max:50'
            ],
            'telephone' => [
                'string',
                'max:10',
                'nullable'
            ],
            'pwd' => [
                'string',
                'required',
                'confirmed',
                'min:12'
            ],
            'address' => [
                'string',
                'max:255',
                'nullable'
            ],
            'city' => [
                'integer',
                'nullable'
            ],
            'postCode' => [
                'integer',
                'nullable'
            ],
            'country' => [
                'integer',
                'nullable'
            ],
            'regionState' => [
                'integer',
                'nullable'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // todo 改寫成 resource
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'status' => 0,
                'message' => '欄位驗證錯誤'
            ], 200)
        );
    }
}
