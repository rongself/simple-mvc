<?php
namespace Application\Module\Simple\Core\Controller;
use Simple\Core\AbstractController;
use Simple\WebSpider\KindleMi;

class IndexController extends AbstractController
{
    public function indexAction()
    {
//        $appId = 'wxfb76e890d56c7f1d';
//        $secret = 'cb4bce26e68ee6203a06a555d676da55';
//        $timestamp = date_timestamp_get(new \DateTime());
//        $nonceStr = 'JKGGJHGJJJJHGH';

//        API::config(new Config($appId,$secret,$timestamp,$nonceStr));

//        $this->view->appId = $appId;
//        $this->view->timestamp = $timestamp;
//        $this->view->nonceStr = $nonceStr;
//        $this->view->signature = API::getSignature();
//        $this->view->data = 'this is message from controller';

        $kindleMi = new KindleMi();
        if($kindleMi->login('rongself','kjhXWnVbVj6M')) {
            $books = $kindleMi->getBookList(0);
            $this->view->books = $books;
        }
    }

    public function autocompleteAction()
    {
        
    }
}