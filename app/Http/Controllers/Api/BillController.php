<?php

namespace App\Http\Controllers\Api;

use App\Model\BillType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BillController extends Controller
{
    public function insert(Request $request)
    {
        $this->validate($request, [
            'room'=>"required|string",
            'name'=>'nullable|string',
            'charge' => "boolean",
            'items.*.type' => 'nullable|integer',
            'items.*.fees' => 'nullable|numeric',
            'items.*.late_fees_base' => 'nullable|numeric',
            'items.*.late_at' => 'nullable|date',
        ]);


        foreach ($request->input('items') as $item) {
            
        }
        return response()->json($request);
    }

    public function billTypes()
    {
        $billTypes = BillType::get();
        $ret = [];
        foreach ($billTypes as $billType) {
            $ret[$billType->id] = $billType;
        }

        return response()->json(['data' => $ret]);
    }
}
