<?php

namespace laucw\lib;

/**
 * 路由类
 * @package laucw\lib
 */
class Route
{
    /**
     * @var string 模块
     */
    public $module;
    /**
     * @var string 控制器
     */
    public $ctrl;
    /**
     * @var string 操作
     */
    public $action;

    /**
     * 路由构造函数
     * @throws \Exception
     */
    public function __construct()
    {
        // 非根域名下时 例如:localhost/site1/index.php
        $requestUri = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
        // 未隐藏index.php时
        $requestUri = str_replace('/index.php', '', $requestUri);

        // 模块/控制器/操作?参数1=值1&参数2=值2...
        $info = parse_url($requestUri);
        $path = isset($info['path']) ? $info['path'] : '/';
        // !isset($info['query']) ?: parse_str($info['query'], $queryString);

        // 兼容URL参数
        if (empty($path) || $path == '/') {
            if (isset($_GET['s'])) {
                $path = $_GET['s'];
            }
        }

        $route = explode('/', trim($path, '/'));

        $this->module = array_shift($route);
        if (!$this->module) {
            $this->module = Config::get('MODULE', 'route');
        }
        $this->ctrl = array_shift($route);
        if (!$this->ctrl) {
            $this->ctrl = Config::get('CTRL', 'route');
        }
        $this->action = array_shift($route);
        if (!$this->action) {
            $this->action = Config::get('ACTION', 'route');
        }

        // 模块/控制器/操作/参数1/值1/参数2/值2...
        $count = count($route) + 2;
        $i = 2;
        while ($i < $count) {
            if (isset($route[$i + 1])) {
                $_GET[$route[$i]] = $route[$i + 1]; // 把参数放入全局变量
            }
            $i += 2;
        }
    }
}
