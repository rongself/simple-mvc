<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/8/8
 * Time: 10:26
 */

namespace Simple\Core\DB;


class Sqlite extends AbstractDbAdapter{

    /**
     * @var \SQLite3
     */
    protected $db;

    public function __construct($filename)
    {
        $this->db = new \SQLite3($filename);
    }

    /**
     * @param string $sql
     * @param array $binds
     * @param null|string $index
     * @return array
     */
    public function query($sql,array $binds = array(),$index = null)
    {
        $stm = $this->db->prepare($sql);
        if (!empty($binds)) {

            foreach ($binds as $key => $value) {
                switch(gettype($value)){
                    case 'integer' :
                        $type = SQLITE3_INTEGER;
                        break;
                    case 'double':
                        $type = SQLITE3_FLOAT;
                        break;
                    case 'NULL':
                        $type = SQLITE3_NULL;
                        break;
                    case 'string' :
                        $type = SQLITE3_TEXT;
                        break;
                    default:
                        $type = SQLITE3_TEXT;
                        break;
                }

                $stm->bindValue(":{$key}",$value,$type);
            }

        }
        $result = $stm->execute();
        $dataSet = array();
        while($row = $result->fetchArray(SQLITE3_ASSOC)){
            if($index !=null){
                $dataSet[$row[$index]] = $row;
            }else{
                $dataSet[] = $row;
            }
        }
        return $dataSet;
    }

    public function exec($sql) {
        return $this->db->exec($sql);
    }

    /**
     * @return \SQLite3
     */
    public function getDb()
    {
        return $this->db;
    }
}