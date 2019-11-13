<?php

namespace app\index\decorator;

/**
 * 模板 响应
 * @package app\index\decorator
 */
class Template
{
    /**
     * @var \laucw\lib\Controller 控制器
     */
    protected $ctrl;

    /**
     * 请求处理前
     * @param $ctrl
     */
    public function beforeRequest($ctrl)
    {
        $this->ctrl = $ctrl;
    }

    /**
     * 请求处理后
     * @param $data
     * @throws \Exception
     */
    public function afterRequest($data)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->ctrl->assign($key, $value);
            }
        }
        $this->ctrl->display();
    }
}
