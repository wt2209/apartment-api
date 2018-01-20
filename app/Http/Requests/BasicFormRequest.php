<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BasicFormRequest
 * 这个类是为了验证不通过后直接返回json
 *
 * @package App\Http\Requests
 */
class BasicFormRequest extends FormRequest
{
    /**
     * @override
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        //取第一个错误信息
        $msg = '';
        foreach($errors as $error) {
            if(is_array($error)) {
                $msg = $error[0];
            } else {
                $msg = $error;
            }
            break;
        }
        return response()->json(['code'=>1, 'msg'=>$msg]);
    }
}
