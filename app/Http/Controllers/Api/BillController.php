<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BillController extends Controller
{
    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        return response()->json($request);
    }
}
