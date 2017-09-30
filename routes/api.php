<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/rooms', function (Request $request) {
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
});
