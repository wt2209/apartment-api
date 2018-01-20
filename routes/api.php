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

Route::post('/login', 'Auth\LoginController@authenticate');

/**
 *  中间件说明：
 *  1. 每次登录时生成token，之后访问时必须携带此token，token值不变
 *  2. 若要登录后每次访问时都生成一个新的token，则要加上 'jwt.refresh' 中间件
 *  3. ’jwt.auth'使用后可以获得已登录的用户信息
 *  4. 由于'RBAC'中间件使用时需要获得已登录的用户信息，因此它必须在’jwt.auth'之后使用。
 *  5. 权限命名方式：请求方法名（get、post、put、delete之一） + 路由
 */
Route::middleware(['jwt.auth', 'api'])->namespace('Api')->group(function () {
    Route::get('/room-structure', 'RoomController@roomStructure')->middleware('RBAC:get-room-structure');
    Route::get('/navigations', 'NavigationController@navigations')->middleware('RBAC:get-navigations');
    Route::post('/navigation', 'NavigationController@insert')->middleware('RBAC:post-navigation');
    Route::get('root-nodes', 'NavigationController@rootNodes')->middleware('RBAC:get-root-nodes');
    Route::get('/rooms', 'RoomController@rooms')->middleware('RBAC:get-rooms');
    Route::get('/rooms/{id}', 'RoomController@rooms')->where('id', '[0-9]+')->middleware('RBAC:get-rooms');
    Route::get('/room-types', 'RoomController@roomTypes')->middleware('RBAC:get-room-types');
    Route::post('/bill', 'BillController@insert')->middleware('RBAC:post-bill');
    Route::get('/people', 'PersonController@people')->middleware('RBAC:get-people');
    Route::get('/people/{:id}', 'PersonController@person')->middleware('RBAC:get-person');
    Route::post('/people', 'PersonController@store')->middleware('RBAC:post-people');
    Route::get('/bill-types', 'BillController@billTypes')->middleware('RBAC:get-bill-types');;

});



