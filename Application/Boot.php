<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/12
 * Time: 0:21
 */
namespace Application;

use Core\AbstractEvent;
use Core\BootManager;
use Core\EventManager;

class Boot {

    public function initDB(BootManager $bootManager)
    {
        $config = $bootManager->config->getConfig('db');
        $defaultDbConfig = $config[$config['default']];
        EventManager::getInstance()->on(AbstractEvent::CONTROLLER_DISPATCH,function($controller) use ($defaultDbConfig){
            /**@var $controller \Core\AbstractController */
            try{
                $ref = new \ReflectionClass($defaultDbConfig['class']);
                $ref->isSubclassOf('\Core\DB\AbstractDbAdapter');
                $controller->setDbAdapter($ref->newInstance($defaultDbConfig['path']));

            }catch (\ReflectionException $e){
                echo $e->getMessage();
            }
        });
    }

}