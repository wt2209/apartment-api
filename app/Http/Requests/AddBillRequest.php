<?php

namespace App\Http\Requests;


class AddBillRequest extends BasicFormRequest
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
            'room'=>"required|string",
            'name'=>'nullable|string',
            'charge' => "boolean",
            'items.*.type' => 'required|integer',
            'items.*.amount' => 'required|numeric',
            'items.*.description' => 'nullable|string',
            'items.*.remark' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'room'=>[
                'required'=>'房间不能为空',
                'string'=>'请正确填写房间号'
            ],
            'name.string'=>'请正确填写姓名',
            'charge.boolean'=>'非法请求，请正确操作',
            'items.*.type'=>[
                'required'=>"费用类型必填",
                'integer'=>'费用类型错误，请正确操作'
            ],
            'items.*.amount'=>[
                'required'=>"金额必填",
                'numeric'=>'金额错误，请输入一个数字'
            ],
            'items.*.description'=>[
                'string'=>"费用说明错误，请正确填写",
            ],
            'items.*.remark'=>[
                'string'=>"备注错误，请正确填写",
            ],
        ];

    }
}
