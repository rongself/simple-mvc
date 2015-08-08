<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/8/8
 * Time: 10:25
 */

namespace Core\DB;


abstract class AbstractDbAdapter {

    public $connection;

    public abstract function query($sql);
    public abstract function getDb();

}