<?php
namespace Application\Game\Controller;
use Application\Game\Model\HelpModel;
use Application\Game\Model\UserModel;
use Core\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $data = array(
            'openId' =>'12353',
            'username' => 'rongself2',
            'image' => 'http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0',
        );
        $model = new UserModel($this->getDbAdapter());
        $helpModel = new HelpModel($this->getDbAdapter());
        //$model->createHelp(1,7,10);
        $distance = $helpModel->getHelpTimes(1);
        $help = $model->getHelpersByUserId(1);
        var_dump($distance);
        var_dump($help);
        var_dump($model->getUsers());
    }

    public function userAction()
    {
        echo '/index/user';
    }
}