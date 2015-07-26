<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/12
 * Time: 0:35
 */

namespace Core;


class BootManager {

	public $router;

	public function __construct(Router $router)
	{
		$this->router = $router;
	}

	public function boot()
	{
		$moduleName = $this->router->getModuleName();
        $controllerName = $this->router->getControllerName();
        $actionName = $this->router->getActionName();
        $params = $this->router->getParams();

        //execute module boot @todo load application boot
        $bootClassName = "\\{$applicationNamespace}\\$moduleName\\Boot";
        $ref = new \ReflectionClass($bootClassName);
        $boot = $ref->newInstance();
        $functions = $ref->getMethods();
        foreach ($functions as $function) {
            $function->invoke($boot);
        }

        $viewDir = self::getConfig()->getConfig('viewDir');
        $viewPath = $applicationNamespace.DIRECTORY_SEPARATOR.$moduleName .DIRECTORY_SEPARATOR .$viewDir . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $actionName . '.php';
        $className = '\\'.ucfirst($applicationNamespace).'\\'.ucfirst($moduleName).'\\Controller\\'.ucfirst($controllerName).'Controller';
        $functionName = $actionName.'Action';

        $view = new View($viewPath);
        $view->setControllerName($className);
        $view->setActionName($functionName);

        $viewRender = new ViewRender($view);
        $viewRender->render();
	}
}