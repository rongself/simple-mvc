<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/8/8
 * Time: 12:13
 */

namespace Core\Model;


use Core\DB\AbstractDbAdapter;

class AbstractModel {

    /**
     * @var AbstractDbAdapter
     */
    protected $db;

    public function __construct(AbstractDbAdapter $dbAdapter)
    {
        $this->db = $dbAdapter;
    }
}