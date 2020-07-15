<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function getAccessToken(){
        $appid="wx95226ae1641aa1b7";
        $secret="fd56081946fee7fbe0c53c7bdb5f3373";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        $res=file_get_contents($url);
        var_dump($res);
    }
    public function getAccessToken2(){
        $appid="wx95226ae1641aa1b7";
        $secret="fd56081946fee7fbe0c53c7bdb5f3373";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        //开启curl
        $ch=curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //执行
        $response=curl_exec($ch);
        curl_close($ch);
         echo $response;
    }
    public function getAccessToken3(){
        $appid="wx95226ae1641aa1b7";
        $secret="fd56081946fee7fbe0c53c7bdb5f3373";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
       $client = new Client();
        $response = $client->request('GET', $url);
        $response_data=$response->getBody();
        echo $response_data;

    }

}
