<?php

namespace laucw\lib;

/**
 * 加载类
 * @package laucw\lib
 */
class Loader
{
    /**
     * @var array 类名映射
     */
    public static $classMap = [];

    /**
     * 自动加载方法
     * @param string $class
     * @return bool
     */
    public static function autoload($class)
    {
        if (isset(self::$classMap[$class])) {
            return true;
        } else {
            $filePath = APP_PATH . '/../' . str_replace('\\', '/', $class) . '.php';
            if (is_file($filePath)) {
                include $filePath;
                self::$classMap[$class] = $filePath;
            } else {
                return false;
            }
        }
    }
}
