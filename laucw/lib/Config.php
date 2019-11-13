<?php

namespace laucw\lib;

/**
 * 配置加载类
 * @package laucw\lib
 */
class Config
{
    /**
     * @var array 配置数组
     */
    public static $conf = [];
    /**
     * @var string 配置文件目录
     */
    public static $config_dir = APP_PATH . '/' . MODULE . '/config/';

    /**
     * 获取单个配置项目
     * @param $name
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function get($name, $file)
    {
        $filePath = self::$config_dir . $file . '.php';
        if (isset(self::$conf[$filePath][$name])) {
            return self::$conf[$filePath][$name];
        } else {
            if (is_file($filePath)) {
                $conf = include $filePath;
                if (isset($conf[$name])) {
                    self::$conf[$filePath] = $conf;
                    return $conf[$name];
                } else {
                    throw new \Exception('没有这个配置项目' . $name);
                }
            } else {
                throw new \Exception('没有这个配置文件' . $filePath);
            }
        }
    }

    /**
     * 获取整个文件配置
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function all($file)
    {
        $filePath = self::$config_dir . $file . '.php';
        if (isset(self::$conf[$filePath])) {
            return self::$conf[$filePath];
        } else {
            if (is_file($filePath)) {
                $conf = include $filePath;
                self::$conf[$filePath] = $conf;
                return $conf;
            } else {
                throw new \Exception('没有这个配置文件' . $filePath);
            }
        }
    }
}
