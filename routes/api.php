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



/*Route::middleware('api')->get('/rooms', function (Request $request) {
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
});*/

Route::get('/login', 'Auth\LoginController@authenticate');

// 中间件：每次登录时生成token，之后访问时必须携带此token，token值不变
// 若要登录后每次访问时都哦生成一个新的token，则要加上 'jwt.refresh' 中间件
Route::namespace('Api')->middleware(['api', 'jwt.auth'])->group(function () {
    Route::get('/navigations', 'NavigationController@navigations');

    Route::get('/rooms', 'RoomController@rooms');
});



