<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/19
 * Time: 22:27
 */

namespace Core;


class View {
    protected $viewPath;
    protected $dataContainer = array();
    public $controllerName;
    public $actionName;

    function __get($name)
    {
        if(isset($this->dataContainer[$name])){
            return $this->dataContainer[$name];
        }
        return null;
    }

    function __set($name,$value)
    {
        $this->dataContainer[$name] = $value;
    }

    public function __construct($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function assign($key,$value)
    {
        $this->dataContainer[$key] = $value;
    }

    protected function render()
    {
        include_once($this->viewPath);
    }

    public function __destruct()
    {
        $this->render();
    }

    public function setControllerName($name)
    {
        $this->controllerName = $name;   
    }

    public function setActionName($name)
    {
        $this->actionName = $name;
    }

}