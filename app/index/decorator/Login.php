<?php

namespace app\index\decorator;

/**
 * 登录装饰器
 * @package app\index\decorator
 */
class Login
{
    /**
     * 请求处理前
     * @param $ctrl
     */
    public function beforeRequest($ctrl) {
        session_start();
        if (empty($_SESSION['isLogin'])) {
            header('location: index/login/index');
            exit;
        }
    }

    /**
     * 请求处理后
     * @param $data
     */
    public function afterRequest($data) {}
}
