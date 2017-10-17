<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Person;
use App\Model\Room;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

/**
 * Class PersonController
 * @package App\Http\Controllers\Api
 */
class PersonController extends Controller
{
    protected $repo;
    public function __construct(PersonRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function people(Request $request)
    {
        $inputs = $request->all();
        $this->validateInputs($inputs);
        $data = $this->repo->getPeople($inputs);
        return response()->json($data);
    }

    public function person($id)
    {
        if (is_numeric($id)) {
            $this->repo->getPerson($id);
        }
    }
    public function store(Request $request)
    {
        $this->validatePostPerson($request);

        $person = $this->repo->storePerson($request->all());
        if ($person != null) {
            return response()->json(['data'=>$person]);
        }
        return response()->json(['error'=>'服务器未知错误'], 500);
    }

    private function validateInputs($inputs)
    {
        $validator = Validator::make($inputs, [
            'search'=>[
                'required',
                Rule::in(['keyword', 'select', 'date'])
            ],
        ]);
        $validator->sometimes('keyword', 'required|max:20', function ($input) {
            return $input->search == 'keyword';
        });
        $validator->sometimes(['type', 'building','unit'], 'required|max:5', function ($input) {
            return $input->search == 'select';
        });
        $validator->sometimes(['start_date', 'end_date'], 'required|date', function ($input) {
            return $input->search == 'date';
        });

        if ($validator->fails()) {
            return response()->json(['error'=>'invalid request'], 400);
        }
    }

    private function validatePostPerson($request)
    {
        $validator = Validator::make($request->all(), [
            'room_id'=>'required|numeric',
            'name'=>'required',
            'checkin_at'=>'nullable|date',
            'contract_start_date'=>'nullable|date_format:Y-m-d',
            'contract_end_date'=>'nullable|date',
            'rent_start_date'=>'nullable|date',
            'rent_end_date'=>'nullable|date',
        ], [
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
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()], 400);
        }
    }
}
