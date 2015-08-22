<?php
namespace Application\Module\Index\Controller;
use Simple\Core\AbstractController;
use WebSpider\KindleMi;
use Wechat\API;
use Wechat\Config;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $appId = 'wxfb76e890d56c7f1d';
        $secret = 'cb4bce26e68ee6203a06a555d676da55';
        $timestamp = date_timestamp_get(new \DateTime());
        $nonceStr = 's8df8ds7fg6f76hg5j4h4gk2l3ty3ydfg';

        $this->view->appId = $appId;
        $this->view->timestamp = $timestamp;
        $this->view->nonceStr = $nonceStr;
        $this->view->signature = API::getSignature(new Config($appId,$secret,$timestamp,$nonceStr));
        $this->view->data = 'this is message from controller';

        $kindleMi = new KindleMi();
        if($kindleMi->login('rongself','kjhXWnVbVj6M')) {
            $books = $kindleMi->getBookList(0);
            $this->view->books = $books;
        }
    }

    public function userAction()
    {
        echo '/index/user';
    }
}