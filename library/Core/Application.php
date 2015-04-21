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
        $moduleName = $router->getModuleName();
        $controllerName = $router->getControllerName();
        $actionName = $router->getActionName();

        //execute module boot @todo load application boot
        $bootClassName = "\\{$applicationNamespace}\\$moduleName\\Boot";
        $ref = new \ReflectionClass($bootClassName);
        $boot = $ref->newInstance();
        $functions = $ref->getMethods();
        foreach ($functions as $function) {
            $function->invoke($boot);
        }

        $viewDir = self::getConfig()->getConfig('viewDir');
        $applicationNamespace = self::getConfig()->getConfig('applicationNamespace');

        $viewPath = $applicationNamespace.DIRECTORY_SEPARATOR.$moduleName .DIRECTORY_SEPARATOR .$viewDir . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $actionName . '.php';
        $className = '\\'.$applicationNamespace.'\\'.ucfirst($moduleName).'\\Controller\\'.ucfirst($controllerName).'Controller';
        $functionName = $actionName.'Action';

        $view = new View($viewPath);

        $controller = new $className();
        if ($controller instanceof AbstractController) {
            $controller->setControllerName($controllerName);
            $controller->setActionName($actionName);
            $controller->setParams($router->getParams());
            $controller->setView($view);
            self::$eventManager->tirgger(AbstractEvent::CONTROLLER_DISPATCH, array($controller));
            call_user_func(array($controller, $functionName));
            self::$eventManager->tirgger(AbstractEvent::CONTROLLER_DISPATCHED, array($controller));
        } else {
            throw new ApplicationException($className . ' must instance of \Core\AbstractController');
        }
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