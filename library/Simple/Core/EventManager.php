<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/8
 * Time: 0:51
 */

namespace Simple\Core;


class EventManager {

    protected $evens = array();

    protected static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function tirgger($event,array $params = array())
    {
        if(isset($this->evens[$event])){
            foreach($this->evens[$event] as $callback){
                if(is_callable($callback)){
                    call_user_func_array($callback,$params);
                }
            }
        }

    }

    public function on($event,callable $callback)
    {
        if(in_array($event,AbstractEvent::$eventTypes)){
            $this->evens[$event][] = $callback;
        }
    }
}