<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/6
 * Time: 0:51
 */

namespace Http;


class Response {
    protected $statusCode;
    protected $headers = array();
    protected $body;

    public function __construct()
    {

    }

    public function getHeader($key)
    {
        return $this->headers[$key];
    }

    /**
     * @param $responseString
     * @return Response
     * @throws BadResponseException
     */
    public static function loadResponseString($responseString)
    {
        $instance = new self();
        $header = array();
        $response = explode("\r\n\r\n",$responseString);
        if(!$response) throw new BadResponseException('A bad response string was passed.');
        $tmp = explode("\r\n",current($response));
        $instance->setBody(next($response));
        foreach($tmp as $key =>$headerRow){
            if($key === 0){
                $header[] = $headerRow;
                $instance->setStatusCode(intval(preg_replace('/^.*\s(\d+)\s.*$/','$1',$headerRow)));
            }else{
                $headerArr = explode(': ',$headerRow);
                $header[$headerArr[0]] = $headerArr[1];
            }
        }
        $instance->setHeaders($header);
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}