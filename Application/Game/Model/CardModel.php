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

    public function create($id)
    {
        $sql = "INSERT INTO dsf_card_to_user (id) VALUES (:id)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':id',$id,SQLITE3_TEXT);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }

    public function getACard($userId)
    {
        $result = $this->db->query('select * from dsf_card_to_user where user_id = :userId limit 1',array('userId'=>$userId));
        $result  = empty($result) ? $result : current($result);
        if($result){
            return $result;
        }else {
            $result = $this->db->query('select * from dsf_card_to_user where user_id is null limit 1');
            $result  = empty($result) ? $result : current($result);
            if($result){
                $this->db->query('update dsf_card_to_user set user_id = :userId,used_time = :usedTime where id = :id',array('id'=>$result['id'],'userId'=>$userId,'usedTime'=>date('Y-m-d H:i:s',time())));
            }
            return $result;
        }
    }
}