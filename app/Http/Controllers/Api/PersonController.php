<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPersonRequest;
use App\Http\Requests\GetPeopleRequest;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

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
    public function people(GetPeopleRequest $request)
    {
        $inputs = $request->all();
        $data = $this->repo->getPeople($inputs);
        return $this->response($data);
    }

    public function person($id)
    {
        $person = $this->repo->getPerson($id);
        return $this->response($person);
    }

    public function store(AddPersonRequest $request)
    {
        $person = $this->repo->storePerson($request->all());

        // TODO 如果是租赁或者单身住户，则自动生成押金等费用
        // 即 自动检查是否需要缴费
        if ($person != null) {
            $this->response($person);
        }

        return $this->errorResponse('存储失败，请重试！');
    }
}
