<?php

namespace app\common\lib;

use app\common\RedisKey;

class Sms
{
    public static function sendTo($phone, $msg)
    {
        return (object)['Code' => 'OK', 'Message' => '请求成功'];
    }
}
