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
    protected $disableRender = false;

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

    public function render()
    {
        if (!$this->disableRender) {
            ob_start();
            include_once($this->viewPath);
            return ob_get_clean();
        }
        return '';
    }

    public function setControllerName($name)
    {
        $this->controllerName = $name;   
    }

    public function setActionName($name)
    {
        $this->actionName = $name;
    }

    /**
     * @param array $dataContainer
     */
    public function setValues(array $values)
    {
        $this->dataContainer = $values;
    }

    public function disableRender()
    {
        $this->disableRender = true;
    }

}