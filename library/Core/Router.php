<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/19
 * Time: 2:01
 */

namespace Core;
class Router {

    protected $uri;
    protected $moduleName;
    protected $controllerName;
    protected $actionName;
    protected $params;

    public function __construct(array $config)
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $module=''; $controller='';$action = '';

        //fix LFI RFI issue
        if (isset($_GET['module'])) {
            $module = preg_replace('/[^(\w\-)]/','',$_GET['module']);
        }

        if (isset($_GET['controller'])) {
            $controller = preg_replace('/[^(\w\-)]/','',$_GET['controller']);
        }

        if (isset($_GET['action'])) {
            $action = preg_replace('/[^(\w\-)]/','',$_GET['action']);
        }

        $this->moduleName =  $module ?: $config['defaultModule'];
        $this->controllerName =  $controller ?: $config['defaultController'];
        $this->actionName =  $action ?: $config['defaultAction'];
    }

    public function getParams()
    {
        return array_merge($_GET,$_POST);
    }

    /**
     * @return mixed
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }


}