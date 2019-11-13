<?php

namespace laucw\lib;

/**
 * 核心类
 * @package laucw\lib
 */
class Kernel
{
    /**
     * 执行应用
     * @throws \Exception
     */
    public static function run()
    {
        $route = new \laucw\lib\Route();
        $module = isset($route->module) ? $route->module : MODULE;
        $ctrlName = $route->ctrl;
        $action = $route->action;

        $ctrlClass = '\app\\' . $module . '\ctrl\\' . ucfirst($ctrlName);
        if (class_exists($ctrlClass)) {
            $ctrl = new $ctrlClass($ctrlName, $action);
            $ctrl->module = $module;
            if (method_exists($ctrlClass, $action)) {
                if (empty($_GET['app'])) {
                    $app = '\app\\' . $module . '\decorator\\Json';
                } else {
                    $app = '\app\\' . $module . '\decorator\\' . $_GET['app'];
                }
                $obj = new $app;
                $obj->beforeRequest($ctrl);
                $data = $ctrl->$action();
                if (!ob_get_contents()) {
                    $obj->afterRequest($data);
                }
            } else {
                throw new \Exception('找不到方法' . $ctrlClass . '->' . $action);
            }
        } else {
            throw new \Exception('找不到控制器' . $ctrlClass);
        }
    }
}
