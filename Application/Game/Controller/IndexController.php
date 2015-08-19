<?php
namespace Application\Game\Controller;
use Application\Game\Model\CardModel;
use Application\Game\Model\HelpModel;
use Application\Game\Model\UserModel;
use Core\AbstractController;
use Overtrue\Wechat\Js;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\User;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $getId = intval($_GET['uid']);
        $wechatConfig = $this->getConfig()->getConfig('wechat');
        list($appId,$token,$secret,$encodingAESKey) = array_values($wechatConfig);

        $js = new Js($appId, $secret);

        $model = new UserModel($this->getDbAdapter());
        $helpModel = new HelpModel($this->getDbAdapter());

        $ip = $model->getUserIP();

        $lastHelpTime = $helpModel->getLastHelpTime($ip,$getId);
        $leftDistance = $helpModel->getLeftDistance($getId);

        $this->view->leftDistance = $leftDistance;
        $this->view->helpedTimes = $helpModel->getHelpTimes($getId);
        $this->view->isSuccess = $leftDistance <= 0;
        $this->view->user = $model->getUserById($getId);
        $this->view->js = $js;

    }

    public function helpAction()
    {
        $getId = intval($_GET['uid']);

        $wechatConfig = $this->getConfig()->getConfig('wechat');
        list($appId,$token,$secret,$encodingAESKey) = array_values($wechatConfig);

        $js = new Js($appId, $secret);

        $model = new UserModel($this->getDbAdapter());
        $helpModel = new HelpModel($this->getDbAdapter());

        $ip = $model->getUserIP();

        $lastHelpTime = $helpModel->getLastHelpTime($ip,$getId);
        $leftDistance = $helpModel->getLeftDistance($getId);

        $this->view->leftDistance = $leftDistance;
        $this->view->isSuccess = $leftDistance <= 0;
        $this->view->helpedTimes = $helpModel->getHelpTimes($getId);
        $this->view->user = $model->getUserById($getId);
        $this->view->js = $js;
    }

    public function setMenuAction()
    {
        $this->view->disableRender();

        $wechatConfig = $this->getConfig()->getConfig('wechat');
        list($appId,$token,$secret,$encodingAESKey) = array_values($wechatConfig);

        $menu = new Menu($appId, $secret);

        $menus = array(
            new MenuItem("帮帮牛郎", 'click', 'HELP_NIU_LANG')
        );

        try {
            $menu->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
    }

    public function addHelpAction()
    {
        $this->view->disableRender();
        $getId = $_POST['uid'];
        $model = new UserModel($this->getDbAdapter());
        $helpModel = new HelpModel($this->getDbAdapter());

        $ip = $model->getUserIP();

        $lastHelpTime = $helpModel->getLastHelpTime($ip,$getId);
        $lastTime = new \DateTime($lastHelpTime);
        $leftDistance = $helpModel->getLeftDistance($getId);
        $now = new \DateTime();
        $distance = 0;
        $isSuccess = false;
        $success = false;
        $message = '';
        if ($leftDistance > 0) {
            if (($lastHelpTime == null || $now->getTimestamp() - $lastTime->getTimestamp() > 24*60*60)) {
                $distance = $helpModel->getRandomHelpDistance($getId);
                $model->createHelp($getId,$ip,$distance);
                $success = true;
            }else {
                $success = false;
                $message = '今天已经帮助过了';
            }
        }else {
            $isSuccess = true;
        }

        return $this->json(array(
            'success' => $success,
            'distance' => $distance,
            'leftDistance' => $leftDistance-$distance,
            'complete' =>$isSuccess,
            'message'=>$message
        ));

    }

    public function useAction()
    {

    }

    public function successAction()
    {
        $model = new CardModel($this->getDbAdapter());

        $wechatConfig = $this->getConfig()->getConfig('wechat');
        list($appId,$token,$secret,$encodingAESKey) = array_values($wechatConfig);
        $openId = $_GET['openId'];
        $userModel = new UserModel($this->getDbAdapter());
        $helpModel = new helpModel($this->getDbAdapter());
        $js = new Js($appId, $secret);
        $this->view->js = $js;
        $user = $userModel->getUserByOpenId($openId);
        if(!$user){
            return;
        }

        $leftDistance = $helpModel->getLeftDistance($user['id']);

        if ($leftDistance >0 ) {
            return;
        }

        $cardNumber = $model->getACard(intval($user['id']));
        $this->view->cardNumber = $cardNumber;
    }

    public function apiAction()
    {
        $this->getView()->disableRender();
        $wechatConfig = $this->getConfig()->getConfig('wechat');
        list($appId,$token,$secret,$encodingAESKey) = array_values($wechatConfig);

        $server = new Server($appId, $token);

        $server->on('event', 'subscribe', function($event){
            return Message::make('text')->content('您好！欢迎关注 overtrue');
        });

        $server->on('event', 'click', function($message) use ($appId, $secret){
            if($message->EventKey = 'HELP_NIU_LANG') {
                $openId = $message->FromUserName;
                $model = new UserModel($this->getDbAdapter());
                $user = $model->getUserByOpenId($openId);
                $ip = $model->getUserIP();
                if (!$user) {
                    $userService = new User($appId, $secret);
                    $userInfo = $userService->get($openId);
                    $userId = $model->createUser($openId,$openId,$ip,$userInfo->nickname);
                }else{
                    $userId = $user['id'];
                }

                $helpModel = new HelpModel($this->getDbAdapter());
                $leftDistance = $helpModel->getLeftDistance($userId);

                if ( $leftDistance > 0 ) {
                    $url = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&uid='.$userId;
                } else {
                    $url = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&controller=index&action=success&openId='.$openId;
                }
                return Message::make('news')->items(function() use ($url){
                    return array(
                        Message::make('news_item')
                            ->title('帮帮牛郎')
                            ->url($url)
                            ->picUrl('http://examples.ronccc.com/wechatsdk/public/images/icon.png'),
                    );
                });
            }
        });

        // 监听所有类型
        $server->on('message', function($message) use ($appId, $secret) {

            if ($message->Content == '我要帮牛郎') {
                $openId = $message->FromUserName;
                $model = new UserModel($this->getDbAdapter());
                $user = $model->getUserByOpenId($openId);
                $ip = $model->getUserIP();
                if (!$user) {
                    $userService = new User($appId, $secret);
                    $userInfo = $userService->get($openId);
                    $userId = $model->createUser($openId,$openId,$ip,$userInfo->nickname);
                }else{
                    $userId = $user['id'];
                }

                $helpModel = new HelpModel($this->getDbAdapter());
                $leftDistance = $helpModel->getLeftDistance($userId);

                if ( $leftDistance > 0 ) {
                    $url = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&uid='.$userId;
                } else {
                    $url = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&controller=index&action=success&openid='.$openId;
                }
                return Message::make('news')->items(function() use ($url){
                    return array(
                        Message::make('news_item')
                            ->title('帮帮牛郎')
                            ->url($url)
                            ->picUrl('http://examples.ronccc.com/wechatsdk/public/images/icon.png'),
                    );
                });
            }

        });

        echo $server->serve();
    }
}