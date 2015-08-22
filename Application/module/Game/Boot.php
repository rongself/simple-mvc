<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/10
 * Time: 0:48
 */
namespace Application\Module\Game;

use Simple\Core\AbstractEvent;
use Simple\Core\Application;
use Simple\Core\EventManager;

class Boot{

    public function init()
    {
        EventManager::getInstance()->on(AbstractEvent::CONTROLLER_DISPATCH,function($controller){
            /**@var $controller \Simple\Core\AbstractController */
            //echo sprintf('this is index module,current controller is %s,action is %s.',$controller->getControllerName(),$controller->getActionName());
        });
    }

}