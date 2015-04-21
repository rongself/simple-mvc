<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/3
 * Time: 23:12
 */

namespace Core;


class Request extends \HttpRequest{

    public function __construct()
    {
        //$_SERVER;
        parent::__construct();
    }

}