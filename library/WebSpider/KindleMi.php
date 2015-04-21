<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/6
 * Time: 1:58
 */

namespace WebSpider;


use Http\Client;

class KindleMi extends Client{

    const LOGIN_URL = 'http://www.kindlemi.com/wp-login.php';
    const SEND_BOOK_URL = 'http://www.kindlemi.com/km-book-send.php';
    const BOOK_LIST_URL = 'http://www.kindlemi.com/books';
    protected $isLogin = false;

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username,$password)
    {
        if(!$this->isLogin()){
            $response = $this->post(self::LOGIN_URL,
                array(
                    'log'=>$username,
                    'pwd'=>$password,//'kjhXWnVbVj6M'
                    'rememberme'=>'forever',
                    'testcookie'=>1
                )
            );
            if($response->getStatusCode() === 302){
                $this->isLogin = true;
                return true;
            }
        }
        return false;
    }

    public function isLogin()
    {
        return $this->isLogin;
    }

    public function getBookList($page)
    {
        if($this->isLogin()){
            $response = $this->get(self::BOOK_LIST_URL);
            $document = new \DOMDocument();
            $bookTemplate = new KindleMiEbook();
            $bookList = array();
            if(@$document->loadHTML($response->getBody())){
                $finder = new \DOMXPath($document);
                $as = $finder->query('//*[@id="booklist"]//h3/a');
                $imgs = $finder->query('//*[@id="booklist"]//li/a/img');
                foreach($as as  $key => $a){
                    /** @var $a \DOMNode*/
                    $name = $a->textContent;
                    $link = $a->attributes->getNamedItem('href')->textContent;
                    $cidAndId = explode('_',substr($link,strrpos($link,'/')+1));
                    $id = current($cidAndId);
                    $categoryId = next($cidAndId);
                    $image = $imgs->item($key)->attributes->getNamedItem('src')->textContent;
                    $eBook = clone $bookTemplate;
                    $eBook->setLink($link)
                        ->setId($id)
                        ->setName($name)
                        ->setImage($image)
                        ->setCategoryId($categoryId);
                    $bookList[] = $eBook;
                }
            }
        }else{
            throw new KindleMiException('You need to login first.');
        }
        return $bookList;
    }

    /**
     * @param $bookId
     * @param $categoryId
     * @param $email
     */
    public function sendBookToEmail($bookId,$categoryId,$email)
    {
        $response = $this->post(self::SEND_BOOK_URL,
            array(
                'bookid'=>$bookId,//'2212',
                'categoryid'=>$categoryId,//'25',
                'name'=>'',
                'postfix'=>'kindle.com',
                'selfmail'=>$email
            )
        );
    }
}