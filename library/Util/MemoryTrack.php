<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/11
 * Time: 23:01
 */

namespace Util;


class MemoryTrack {

    private static $startUsage;
    private static $endUsage;
    private static $applicationUsage;

    public static function start()
    {
        return self::$startUsage = memory_get_usage(true);
    }

    public static function end()
    {
        return self::$endUsage = memory_get_usage(true);
    }

    public static function usage()
    {
        return self::$applicationUsage = round(self::$endUsage-self::$startUsage,2);
    }

}