<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/7
 * Time: 23:39
 */

namespace Core;


class Config {

    protected $configData = array();

    public function __construct($file = null)
    {
        if (isset($file)) {
            $this->loadFromFile($file);
        }
    }

    public function loadFromFile($file)
    {
        $this->configData = include $file;
    }

    /**
     * @return array
     */
    public function getConfig($key)
    {
        return $this->configData[$key];
    }

    /**
     * @param array $configData
     */
    public function setConfig($key,$configData)
    {
        $this->configData[$key] = $configData;
    }


}