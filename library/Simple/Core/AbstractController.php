<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/19
 * Time: 1:59
 */

namespace Simple\Core;


abstract class AbstractController {

    protected $controllerName;
    protected $actionName;
    protected $params;
    protected $config;
    /**
     * @var \Simple\Core\DB\AbstractDbAdapter
     */
    protected $dbAdapter;

    /**
     * @var $view \Simple\Core\View
     */
    protected $view;

    public function __construct()
    {

    }
    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param mixed $controllerName
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @return \Simple\Core\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    public function post()
    {
        $functionName = $this->getActionName() . 'Action';
        call_user_func(array($this,$functionName));
        echo $this->getView()->render();
    }

    /**
     * @return DB\AbstractDbAdapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param DB\AbstractDbAdapter $dbAdapter
     */
    public function setDbAdapter(DB\AbstractDbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    protected function json(array $data = array())
    {
        $this->getView()->disableRender();
        header('Content-type: text/json');
        echo json_encode($data);
    }

}