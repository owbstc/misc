<?php

namespace app\index\ctrl;

use app\common\lib\Redis;
use app\common\lib\Sms;
use app\common\RedisKey;
use laucw\lib\Controller;

/**
 * 发送短信
 * @package app\index\ctrl
 */
class Send extends Controller
{
    /**
     * 发送登录用的短信验证码
     */
    public function index()
    {
        $phone = isset($_GET['phone']) ? $_GET['phone'] : null;
        if (empty($phone)) {
            throw new \Exception('参数错误');
        }

        try {
            $code = rand(1000, 9999);
            $response = Sms::sendTo($phone, $code);
        } catch(\Exception $e) {
            throw new \Exception('验证码服务异常' . $e->getMessage());
        }

        if ($response->Code !== 'OK') {
            throw new \Exception('验证码发送失败');
        } else {
            // 保存登录验证码，有效期60秒
            Redis::instance()->set(RedisKey::sms($phone), $code, 60);
            return compact('code');
        }
    }
}
