<?php
namespace Application\Game\Model;

class UserModel extends \Core\Model\AbstractModel {

    public function getUsers()
    {
        return $this->db->query('select * from dsf_user',array(),'id');
    }

    public function createUser($username,$openId,$image)
    {
        $sql = "INSERT INTO dsf_user (username,open_id,image) VALUES (:username,:openId,:image)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':username',$username,SQLITE3_TEXT);
        $pre->bindValue(':openId',$openId,SQLITE3_TEXT);
        $pre->bindValue(':image',$image,SQLITE3_TEXT);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }

    public function createHelp($userId,$helperId,$distance)
    {
        $sql = "INSERT INTO dsf_help (user_id,helper_id,distance) VALUES (:userId,:helperId,:distance)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':userId',$userId,SQLITE3_INTEGER);
        $pre->bindValue(':helperId',$helperId,SQLITE3_INTEGER);
        $pre->bindValue(':distance',$distance,SQLITE3_INTEGER);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }

    public function getHelpersByUserId($userId)
    {
        return $this->db->query('select * from dsf_help where user_id = :userId',array('userId' => $userId));
    }

    public function deleteAll()
    {
        $this->db->exec('delete from dsf_user');
    }
}