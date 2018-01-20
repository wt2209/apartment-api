<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddBillRequest;
use App\Model\BillType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BillController extends Controller
{
    public function insert(AddBillRequest $request)
    {
        foreach ($request->input('items') as $item) {
            
        }

        return $this->response([]);
    }

    public function billTypes()
    {
        $billTypes = BillType::get();
        $ret = [];
        foreach ($billTypes as $billType) {
            $ret[$billType->id] = $billType;
        }
        return $this->response($ret);
    }
}
