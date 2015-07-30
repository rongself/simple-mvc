<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/19
 * Time: 1:32
 */

namespace Core;

class Application
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var BootManager
     */
    protected $bootManager;

    /**
     * @var EventManager
     */
    protected  $eventManager;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    public function run()
    {

        if(!isset($this->bootManager))
        {
            $this->bootManager = new BootManager($this->config);
        }
        $this->bootManager->boot();
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

}