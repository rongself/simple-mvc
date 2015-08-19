<?php
namespace Application\Game\Model;

class UserModel extends \Core\Model\AbstractModel {

    public function getUsers()
    {
        return $this->db->query('select * from dsf_user',array(),'id');
    }

    public function createUser($username,$openId,$ip,$nickname)
    {
        $sql = "INSERT INTO dsf_user (username,open_id,ip,nickname) VALUES (:username,:openId,:ip,:nickname)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':username',$username,SQLITE3_TEXT);
        $pre->bindValue(':openId',$openId,SQLITE3_TEXT);
        $pre->bindValue(':ip',$ip,SQLITE3_TEXT);
        $pre->bindValue(':nickname',$nickname,SQLITE3_TEXT);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }

    public function createHelp($userId,$ip,$distance)
    {
        $sql = "INSERT INTO dsf_help (user_id,helper_id,distance,ip) VALUES (:userId,:helperId,:distance,:ip)";
        $pre = $this->db->getDb()->prepare($sql);
        $pre->bindValue(':userId',$userId,SQLITE3_INTEGER);
        $pre->bindValue(':helperId',ip2long($ip),SQLITE3_INTEGER);
        $pre->bindValue(':distance',$distance,SQLITE3_INTEGER);
        $pre->bindValue(':ip',$this->getUserIP(),SQLITE3_TEXT);

        $pre->execute();
        return $this->db->getDb()->lastInsertRowID();
    }

    public function getHelpersByUserId($userId)
    {
        $result = $this->db->query('select * from dsf_help where user_id = :userId',array('userId' => $userId));
        return empty($result) ? $result : current($result);
    }

    public function deleteAll()
    {
        $this->db->exec('delete from dsf_user');
    }

    public function getUserById($userId)
    {
        $result = $this->db->query('select * from dsf_user where id = :userId',array('userId' => $userId));
        return empty($result) ? $result : current($result);
    }

    public function getUserByOpenId($openId)
    {
        $result = $this->db->query('select * from dsf_user where open_id = :openId',array('openId' => $openId));
        return empty($result) ? $result : current($result);
    }

    public function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    public function setInit($userId,$status)
    {
        return $this->db->query('update dsf_user set inited = :inited where id = :id',array('inited'=>intval($status),'id'=>$userId));
    }

}