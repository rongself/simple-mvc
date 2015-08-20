<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/8/8
 * Time: 13:23
 */

namespace Application\Game\Model;


use Core\Model\AbstractModel;

class HelpModel extends AbstractModel{

    /**
     * 鹊桥的长度
     */
    const TOTAL_DISTANCE = 100;
    const HELP_TIMES = 5;

    public function getRandomHelpDistance($userId)
    {
        $helpedTimes = $this->getHelpTimes($userId);
        $leftDistance = $this->getLeftDistance($userId);
        if ($helpedTimes < self::HELP_TIMES - 1) {
            $distance =  floor($leftDistance*(rand(1,50)/100));
        }else{
            $distance = $leftDistance;
        }
        return $distance;
    }

    public function getLeftDistance($userId)
    {
        $helpedDistance = $this->getUserHelpDistance($userId);
        return self::TOTAL_DISTANCE - $helpedDistance;
    }

    public function getUserHelpDistance($userId)
    {
        $result = $this->db->query('select sum(distance) as `sum` from dsf_help where user_id = :userId group by user_id',array('userId' => $userId));
        return empty($result) ? null:current($result)['sum'];
    }

    public function getHelpTimes($userId)
    {
        $result = $this->db->query('select count(*) as `count` from dsf_help where user_id = :userId',array('userId' => $userId));
        return empty($result) ? null:current($result)['count'];
    }

    public function getLastHelpTime($ip,$userId)
    {

        $result = $this->db->query('select create_time as createTime from dsf_help where ip = :ip and user_id = :userId order by id desc limit 1 ',array('ip' => $ip,'userId' => $userId));
        return empty($result) ? null:current($result)['createTime'];
    }
}