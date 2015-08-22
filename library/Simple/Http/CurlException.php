<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/5
 * Time: 23:44
 */

namespace Simple\Http;

class CurlException extends \Exception{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}