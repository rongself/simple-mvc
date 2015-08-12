<?php
namespace Application\Game\Controller;
use Application\Game\Model\HelpModel;
use Application\Game\Model\UserModel;
use Core\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $getId = 385;
        $currentUserId = 390;

        $model = new UserModel($this->getDbAdapter());
        $helpModel = new HelpModel($this->getDbAdapter());

        $lastHelpTime = $helpModel->getLastHelpTime($currentUserId,$getId);
        $lastTime = new \DateTime($lastHelpTime);
        $leftDistance = $helpModel->getLeftDistance($getId);
        $now = new \DateTime();
        $distance = 0;

        if ($leftDistance > 0) {
            if (($lastHelpTime == null || $now->getTimestamp() - $lastTime->getTimestamp() > 24*60*60)) {
                    $distance = $helpModel->getRandomHelpDistance($getId);
                $model->createHelp($getId,$currentUserId,$distance);
            }else {
                $this->view->message = '今天已经帮助过了';
            }
        }else {
            $this->view->message = '相会了';
        }

        $this->view->distance = $distance;
        $this->view->leftDistance = $leftDistance - intval($distance);
        $this->view->helpedTimes = $helpModel->getHelpTimes($getId);
        $this->view->user = $model->getUserById($getId);
        $this->view->helper = $model->getUserById($currentUserId);
    }

    public function userAction()
    {
        echo '/index/user';
    }
}