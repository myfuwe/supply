<?php

 namespace Qdysup\core;
class Base
{
    public $app_secret = '';
    public $app_key = '';
    public $app_url = "";
    private $param = array();

    public function getAppKey()
    {
        return  $this->app_key;
    }

    public function getAppSecret()
    {
        return $this->app_secret;
    }
    public function apiSend($action,$params=[]) {

        $this->param = $params;
        $this->param['app_key'] = $this->app_key;
        $this->param['app_secret'] = base64_encode($this->app_secret);
        $this->param['timestamp'] = date('Y-m-d H:i:s');
        //获取签名
        $this->param['sign'] = $this->getSign();

        $url=$this->app_url.$action;
        var_dump($url);
        return Http::curl_request($url,$this->param);

    }

    //生成签名
    public function getSign(){
        $app_secret = $this->param['app_secret'];
        unset($this->param['sign'], $this->param['app_secret']);
        $param = $this->param;
        ksort($param);
        reset($param);
        $string = '';
        foreach ($param as $key => $val) {
            $string .= $key . $val;
        }
        $string = $this->app_secret . $string . $this->app_secret;
        $this->param['app_secret'] = $app_secret;
        return strtoupper(md5($string));
    }

}