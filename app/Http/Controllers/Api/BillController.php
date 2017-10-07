<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function insert(Request $request)
    {
        return response()->json($request);
    }
}
