<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/26
 * Time: 0:17
 */

namespace Wechat;


class Config {

    public $appId;
    public $secret;
    public $timestamp;
    public $nonceStr;

    public function __construct($appId,$secret,$timestamp,$nonceStr)
    {
        $this->appId = $appId;
        $this->secret = $secret;
        $this->nonceStr = $nonceStr;
        $this->timestamp = $timestamp;
    }

    public function toArray()
    {
        return get_class_vars($this);
    }
}