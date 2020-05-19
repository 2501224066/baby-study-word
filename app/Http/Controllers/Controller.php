<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\Resource;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * 接口请求成功
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [])
    {
        if ($data instanceof Resource && $data->resource == null) {
            $data = [];
        }

        return response()->json([
            'code' => 100000,
            'message' => __('code.100000'),
            'data' => empty($data) ? (object)$data : $data
        ]);
    }

    /**
     * 接口请求失败
     * @param string $msg
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail($msg = '', $code = '200202')
    {
        return response()->json([
            'code' => (int)$code,
            'message' => $msg === '' ? __('code.' . $code) : $msg,
            'data' => (object)[]
        ]);
    }
}
