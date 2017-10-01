<?php
/**
 * Created by PhpStorm.
 * User: WT
 * Date: 2017/9/30
 * Time: 17:58
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RoomController extends Controller
{

    public function rooms(Request $request)
    {
        return $request->user();
    }

}
