<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param $data
     * @param $code 0:success, 1:fail, 2:noPermission
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function baseResponse($data, $code, $msg)
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($result);
    }

    protected function response($data)
    {
        return $this->baseResponse($data, 0, 'success');
    }

    protected function errorResponse($msg = 'failed')
    {
        return $this->baseResponse([], 1, $msg);
    }

    protected function noPermissionResponse()
    {
        return $this->baseResponse([], 2, 'no permission');
    }
}
