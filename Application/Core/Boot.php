<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/10
 * Time: 0:48
 */
namespace Application\Core;

use Simple\Core\AbstractEvent;
use Simple\Core\Application;

class Boot{

    public function init()
    {
        Application::getEventManager()->on(AbstractEvent::CONTROLLER_DISPATCH,function($controller){
           
        });
    }

}