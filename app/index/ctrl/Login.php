<?php

namespace app\index\ctrl;

use app\common\lib\Redis;
use app\common\RedisKey;
use laucw\lib\Controller;

/**
 * 登录
 * @package app\index\ctrl
 */
class Login extends Controller
{
    public function index()
    {
        // p(Redis::instance()->keys('*'));exit;

        $phone = isset($_GET['phone']) ? $_GET['phone'] : null;
        $code = isset($_GET['code']) ? $_GET['code'] : null;
        if (empty($phone) || empty($code)) {
            throw new \Exception('参数错误');
        }

        if ($code != Redis::instance()->get(RedisKey::sms($phone))) {
            throw new \Exception('验证码错误');
        } else {
            // 删除登录验证码
            Redis::instance()->del(RedisKey::sms($phone));

            $user = [
                'username' => $phone,
                'key' => md5(RedisKey::user($phone)),
                'time' => time(),
            ];
            // 保存登录信息
            Redis::instance()->set(RedisKey::user($phone), json_encode($user));
            return $user;
        }
    }
}
