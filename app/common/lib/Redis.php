<?php

namespace app\common\lib;

use laucw\lib\Config;

/*
 * 多单例类
 */

class Redis
{
    private static $instance = [];

    private function __construct($config_name)
    {
        $config = Config::all($config_name);

        $this->origin = new \Redis();
        $this->origin->connect($config['host'], $config['port']);
        if (isset($config['password'])) {
            $this->origin->auth($config['password']);
        }
        if (isset($config['database'])) {
            $this->origin->select($config['database']);
        }
    }

    private function __clone()
    { }

    // Get instance
    public static function instance($config_name = 'redis')
    {
        if (empty(self::$instance[$config_name])) {
            self::$instance[$config_name] = new self($config_name);
        }
        return self::$instance[$config_name];
    }

    // Other methods default
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->origin, $name], $arguments);
    }

    // Rewrite set
    public function set($key, $value, $time_out = 0)
    {
        $value = gzcompress($value); // Compress
        $result = $this->origin->set($key, $value);
        if ($time_out > 0) {
            $this->origin->expire($key, $time_out);
        }
        return $result;
    }

    // Rewrite get
    public function get($key)
    {
        $result = $this->origin->get($key);
        $result = gzuncompress($result); // unCompress
        return $result;
    }

    // Rewrite close
    public function close($config_name = 'redis')
    {
        $this->origin->close();
        if (isset(self::$instance[$config_name])) {
            self::$instance[$config_name] = null;
        }
    }
}
