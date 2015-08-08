<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/8/8
 * Time: 12:17
 */

namespace Application\Game\Model;


use Core\Model\AbstractModel;

class CardModel extends AbstractModel {

    public function create($data)
    {
        $sql = "INSERT INTO dsf_user (id,card_number) VALUES (:id,:card_number,)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':card_number',$data['card_number'],SQLITE3_TEXT);
        $pre->bindValue(':id',$data['id'],SQLITE3_TEXT);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }
}