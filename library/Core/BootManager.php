<?php/** * Created by PhpStorm. * User: rongself * Date: 2015/4/12 * Time: 0:35 */namespace Core;class BootManager{    public $router;    protected $config;    public function __construct(Config $config)    {        $this->config = $config;        $this->router = new Router($this->config->getConfig('routerOptions'));    }    public function boot()    {        $applicationNamespace = $this->config->getConfig('applicationNamespace');        $moduleName = $this->router->getModuleName();        $controllerName = $this->router->getControllerName();        $actionName = $this->router->getActionName();        $params = $this->router->getParams();        //execute module boot @todo load application boot        $bootClassName = "\\{$applicationNamespace}\\".ucfirst($moduleName)."\\Boot";        $ref = new \ReflectionClass($bootClassName);        $boot = $ref->newInstance();        $functions = $ref->getMethods();        foreach ($functions as $function) {            $function->invoke($boot);        }        $viewDir = $this->config->getConfig('viewDir');        $viewPath = $applicationNamespace . DS . ucfirst($moduleName) . $viewDir . DS . $controllerName . DS . $actionName . '.php';        $className = '\\' . ucfirst($applicationNamespace) . '\\' . ucfirst($moduleName) . '\\Controller\\' . ucfirst($controllerName) . 'Controller';        $view = new View($viewPath);        $controllerRef = new \ReflectionClass($className);        $controller = $controllerRef->newInstance();        if ($controller instanceof AbstractController) {            $eventManger = EventManager::getInstance();            $controller->setControllerName($controllerName);            $controller->setActionName($actionName);            $controller->setParams($params);            $controller->setView($view);            $eventManger->tirgger(AbstractEvent::CONTROLLER_DISPATCH, array($controller));            $controller->post();            $eventManger->tirgger(AbstractEvent::CONTROLLER_POST, array($controller));        }    }}