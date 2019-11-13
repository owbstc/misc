<?php

namespace laucw;

// 基础文件

// 常量
if (!defined('APP_PATH')) define('APP_PATH', __DIR__ . '/../app');
if (!defined('FRANKWORK')) define('FRANKWORK', __DIR__);
if (!defined('MODULE')) define('MODULE', 'index');
if (!defined('DEBUG')) define('DEBUG', true);

if (DEBUG) {
    error_reporting(-1); // 显示所有错误
    ini_set('display_errors', 'On');
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
    ini_set('display_errors', 'Off');
}

include_once FRANKWORK . '/common/function.php';

// 自动加载
require_once FRANKWORK . '/lib/Loader.php';
spl_autoload_register('\laucw\lib\Loader::autoload');
