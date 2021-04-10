<?php


namespace Qdysup\core;


class Http
{
//http 请求
    public static  function curl_request($url, $post, $headers=null, $timeout=120, $json=false){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        if(isset( $_SERVER['HTTP_USER_AGENT'])){
            curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        }
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


        if($headers!=null) {
            $headerArray=array();
            array_push($headerArray,'Content-Type: application/json');
            foreach ($headers as  $key => $value) {
                array_push($headerArray,$key.":".$value);
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER,  $headerArray);
        }

        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($post)?http_build_query($post):$post);
        }

        $TLS = substr($url, 0, 8) == "https://" ? true : false;

        if($TLS) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }

        // 关闭SSL验证
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);



        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);


        if ($json){

            return json_decode($data,true);
        }
        return $data;

    }
}