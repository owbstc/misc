<?php

namespace app\index\ctrl;

use laucw\lib\Controller;

/**
 * 首页
 * @package app\index\ctrl
 */
class Home extends Controller
{
    public function index()
    {
        // $s = \microtime(true);
        // $model = new \laucw\lib\Model;
        // echo \microtime(true) - $s . '<br>';
        // $sql = 'select * from category';
        // $ret = $model->query($sql);
        // p($ret->fetch(\PDO::FETCH_ASSOC));
        // p($ret->fetchAll(\PDO::FETCH_ASSOC));

        $title = '这是标题';
        // $this->assign('title', $title);
        $data = 'hello world';
        // $this->assign('data', $data);

        // $this->display();
        return [
            'title' => $title,
            'data' => $data,
        ];
    }
}
