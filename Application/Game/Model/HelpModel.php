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
    const HELP_TIMES = 10;

    public $step = array(1,2,5,10,20,30);

    public function getRandomHelpDistance($userId)
    {
        $helpedDistance = $this->getUserHelpDistance($userId);
        $helpedTimes = $this->getHelpTimes($userId);
        if ($helpedTimes < self::HELP_TIMES) {

        }
    }

    public function getUserHelpDistance($userId)
    {
        $result = $this->db->query('select sum(distance) as `sum` from dsf_help where user_id = :userId group by user_id',array('userId' => $userId));
        return $result[0]['sum'];
    }

    public function getHelpTimes($userId)
    {
        $result = $this->db->query('select count(*) as `count` from dsf_help where user_id = :userId',array('userId' => $userId));
        return $result[0]['count'];
    }

    public function getLastHelpTime($helperId,$userId)
    {
        $result = $this->db->query('select create_time as createTime from dsf_help where helper_id = :helperId and user_id = :userId limit 1 order by id desc',array('helperId' => $helperId,'userId' => $userId));
        return $result[0]['createTime'];
    }
}