<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function rooms()
    {
        $rooms = [[
            'display_name'=>'7-1-101',
            'person_number'=>4,
            'building'=>7,
            'unit'=>1,
            'persons'=>[
                [
                    'name'=>'张三',
                    'gender'=>'男',
                ],
                [
                    'name'=>'李四',
                    'gender'=>'女',
                ],
            ],
        ]];
        return response()->json($rooms);
    }
}
