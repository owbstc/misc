<?php

namespace laucw\lib;

/**
 * 控制器类
 * @package laucw\lib
 */
class Controller
{
    /**
     * @var array 变量数组
     */
    public $data = [];
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
     * @var string 模板文件夹路径
     */
    public $template_dir;

    /**
     * 控制器构造方法
     * @param $ctrl
     * @param $action
     */
    public function __construct($ctrl, $action)
    {
        $this->ctrl = $ctrl;
        $this->action = $action;
        $this->template_dir = APP_PATH . '/' . MODULE . '/views/';
    }

    /**
     * 模板变量赋值
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        if (is_array($name)) {
            $this->data = array_merge($this->data, $name);
        } else {
            $this->data[$name] = $value;
        }
    }

    /**
     * 模板渲染
     * @param string $file
     * @throws \Exception
     */
    public function display($file = '')
    {
        if (empty($file)) {
            $file = strtolower($this->ctrl) . '/' . $this->action . '.html';
        }
        $filePath = $this->template_dir . $file;
        if (is_file($filePath)) {
            if ($this->data) {
                extract($this->data);
            }
            include $filePath;
        } else {
            throw new \Exception('找不到模板文件' . $filePath);
        }
    }
}
