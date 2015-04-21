<?php
/**
 * Created by PhpStorm.
 * User: rongself
 * Date: 2015/4/5
 * Time: 23:21
 */

namespace Http;


class Client {

    protected $curlSession;
    protected $cookiesPath;

    public function __construct()
    {
        $this->curlSession = curl_init();
        $this->cookiesPath = PROJECT_ROOT.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cookies';
    }

    /**
     * @param $url
     * @param array $params
     * @return Response
     * @throws BadResponseException
     * @throws CurlException
     */
    public function post($url,array $params = array())
    {
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_POST =>1,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_COOKIEJAR => $this->cookiesPath.DIRECTORY_SEPARATOR.md5(preg_replace('/^https?:\/\/([\w\.\-]+)\/*.*/','$1',$url))
        );
        $result = $this->sendRequest($options);
        return Response::loadResponseString($result);
    }

    /**
     * @param $url
     * @param array $params
     * @return Response
     * @throws BadResponseException
     * @throws CurlException
     */
    public function get($url,array $params = array())
    {
        $options = array(
            CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($params),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HEADER => 1,
            CURLOPT_COOKIEJAR => $this->cookiesPath.DIRECTORY_SEPARATOR.md5(preg_replace('/^https?:\/\/([\w\.\-]+)\/*.*/','$1',$url))
        );
        $result = $this->sendRequest($options);
        return Response::loadResponseString($result);

    }

    /**
     * @param array $options
     * @return mixed
     * @throws CurlException
     */
    protected function sendRequest(array $options)
    {
        curl_setopt_array($this->curlSession,$options);
        if(false === ($result = curl_exec($this->curlSession))){
            throw new CurlException(curl_error($this->curlSession));
        }
        return $result;
    }

    /**
     * Manually close connect
     */
    public function destroy()
    {
        curl_close($this->curlSession);
    }

    public function __destruct()
    {
        $this->destroy();
    }
}