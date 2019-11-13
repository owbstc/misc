<?php

namespace app\index\decorator;

/**
 * Json 响应
 * @package app\index\decorator
 */
class Json
{
    /**
     * 请求处理前
     * @param $ctrl
     */
    public function beforeRequest($ctrl) {}

    /**
     * 请求处理后
     * @param $data
     */
    public function afterRequest($data)
    {
        echo json_encode([
            'errcode' => 0,
            'errmsg' => '',
            'data' => $data,
        ]);
    }
}
