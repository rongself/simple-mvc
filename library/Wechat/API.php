<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/3/26
 * Time: 0:15
 */

namespace Wechat;


class API {
    /**
     * @var $config Config
     */
    private static $config;

    public static function getSignature(Config $config)
    {
        self::$config = $config;
        $signatureArray = array(
            'jsapi_ticket' => self::getJsApiTicket(),
            'noncestr' => $config->nonceStr,
            'timestamp' => $config->timestamp,
            'url' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
        );
        $query = '';
        $i = 0;
        foreach($signatureArray as $key=>$item){
            $query .= "{$key}={$item}";
            if($i+1!=count($signatureArray)){
                $query .= '&';
            }
            $i++;
        }
        return sha1($query);
    }

    private static function getAccessToken()
    {
        $accessUrl = sprintf('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',self::$config->appId,self::$config->secret);
        $result = json_decode(file_get_contents($accessUrl),true);
        return $result['access_token'];
    }

    /**
     * @return mixed
     */
    private static function getJsApiTicket()
    {
        $jsTicketUrl = sprintf('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi',self::getAccessToken());
        $result = json_decode(file_get_contents($jsTicketUrl),true);
        return $result['ticket'];
    }

}