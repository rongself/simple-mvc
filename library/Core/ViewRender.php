<?php
/**
* 
*/
class ViewRender
{
	
	public $view;

	public function __construct(View $view)
	{
		$this->view = $view;
	}

	public function render()
	{
		$className = $this->view->controllerName;
		$actionName = $this->view->actionName;
		$controller = new $className();
        if ($controller instanceof AbstractController) {
            $controller->setControllerName($controllerName);
            $controller->setActionName($actionName);
            $controller->setParams($params);
            $controller->setView($this->view);
            self::$eventManager->tirgger(AbstractEvent::CONTROLLER_DISPATCH, array($controller));
            call_user_func(array($controller, $functionName));
            self::$eventManager->tirgger(AbstractEvent::CONTROLLER_DISPATCHED, array($controller));
        } else {
            throw new ApplicationException($className . ' must instance of \Core\AbstractController');
        }
	}
}