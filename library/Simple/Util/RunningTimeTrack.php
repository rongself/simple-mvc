<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/11
 * Time: 22:49
 */

namespace Simple\Util;


class RunningTimeTrack {

    private static $startTime;
    private static $endTime;
    private static $timeUsage;

    public static function start()
    {
        return self::$startTime = microtime(true);
    }

    public static function end()
    {
        return self::$endTime = microtime(true);
    }

    public static function usage()
    {
        return self::$timeUsage = round(self::$endTime-self::$startTime,2);
    }
}