<?php

namespace app\common;

class RedisKey
{
    public static function sms($phone)
    {
        return 'sms_' . $phone;
    }

    public static function user($phone)
    {
        return 'user_' . $phone;
    }
}
