<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/19
 * Time: 1:32
 */

namespace Core;

class Application
{
    /**
     * @var Config
     */
    protected static $config;

    /**
     * @var EventManager
     */
    protected static $eventManager;


    public static function run(Config $config)
    {
        self::$config = $config;
        self::$eventManager = EventManager::getInstance();
        $applicationNamespace = self::getConfig()->getConfig('applicationNamespace');

        $router = new Router($config->getConfig('routerOptions'));
        $boot = new BootManager($router);
        $boot->boot();
    }

    /**
     * @return mixed
     */
    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * @param array $config
     */
    public static function setConfig($config)
    {
        self::$config = $config;
    }

    /**
     * @return EventManager
     */
    public static function getEventManager()
    {
        return self::$eventManager;
    }

    /**
     * @param mixed $eventManager
     */
    public static function setEventManager($eventManager)
    {
        self::$eventManager = $eventManager;
    }

}