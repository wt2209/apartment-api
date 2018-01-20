<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class GetPeopleRequest extends BasicFormRequest
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
            'search'=>[
                'required',
                Rule::in(['keyword', 'select', 'date'])
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('keyword', 'required|max:20', function ($input) {
            return $input->search == 'keyword';
        });
        $validator->sometimes(['type', 'building','unit'], 'required|max:5', function ($input) {
            return $input->search == 'select';
        });
        $validator->sometimes(['start_date', 'end_date'], 'required|date', function ($input) {
            return $input->search == 'date';
        });
    }
}
