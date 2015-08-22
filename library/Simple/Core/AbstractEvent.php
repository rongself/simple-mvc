<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/10
 * Time: 0:16
 */

namespace Simple\Core;


abstract class AbstractEvent {
    const CONTROLLER_DISPATCH = 'controllerDispatch';
    const CONTROLLER_POST = 'controllerDispatched';
    public static $eventTypes = array(
        self::CONTROLLER_DISPATCH,
        self::CONTROLLER_POST,
    );
}