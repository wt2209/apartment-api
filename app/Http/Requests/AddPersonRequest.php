<?php

namespace App\Http\Requests;


class AddPersonRequest extends BasicFormRequest
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
            'room_id'=>'required|numeric',
            'name'=>'required',
            'checkin_at'=>'nullable|date',
            'contract_start_date'=>'nullable|date_format:Y-m-d',
            'contract_end_date'=>'nullable|date',
            'rent_start_date'=>'nullable|date',
            'rent_end_date'=>'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'room_id'=>[
                'required'=>'房间不能为空',
                'numeric'=>'非法请求'
            ],
            'name.required'=>'姓名不能为空',
            'checkin_at.date'=>'入住时间格式错误，格式为：2017-10-1',
            'contract_start_date.date'=>'劳动合同格式错误，格式为：2017-10-1',
            'contract_end_date.date'=>'劳动合同格式错误，格式为：2017-10-1',
            'rent_start_date.date'=>'租房合同格式错误，格式为：2017-10-1',
            'rent_end_date.date'=>'租房合同格式错误，格式为：2017-10-1',
        ];
    }
}
