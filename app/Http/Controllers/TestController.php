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
    public function test1(){
        $url="http://api.1911.com/user/info";
         $response=file_get_contents($url);
         var_dump($response);
    }
    public function test2(){
        echo "我是你爷爷0090";
    }
    public function jiami(){
        $data="嘉俊抬头望天空，我好像一大傻b";
        $key="1911api";
        $iv="aaaabbbbccccdddd";
        $encrypt_data=openssl_encrypt($data,'AES-256-CBC',$key,OPENSSL_RAW_DATA,$iv);
        var_dump($encrypt_data);
        $all_data=base64_encode($encrypt_data);
//        $all_data=[
//            'data'=>base64_encode($encrypt_data)
//        ];
        $url="http://api.1911.com/jiemi";
        //var_dump($encrypt_data);echo "</br>";
        $client=new Client();
        $response=$client->request('POST',$url,[
            'form_params'=>[
                'data'=>$all_data
            ]
        ]);
        echo $response->getBody();
//die;
//        $ch=curl_init();
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($all_data));
//        curl_setopt($ch,CURLOPT_POST,1);
//        $response=curl_exec($ch);
//        curl_close($ch);
//        echo "解密的数据：".$response;
    }
     public function aes(){



        $data="白云白云，我是黑土";
        $content=file_get_contents(storage_path("/key/pub.key"));
        $pub_key=openssl_get_publickey($content);
        openssl_public_encrypt($data,$enc_data,$pub_key);
        $data=base64_encode($enc_data);
        $url="http://api.1911.com/aes";
//        $url="http://api.1911.com/aes?data=".$data;
//                 $client=new Client();
//        $response=$client->request('GET',$url);
//       echo $response->getBody();
        $client=new Client();
        $response=$client->request('POST',$url,[
            'form_params'=>[
                'data'=>$data
            ]
        ]);
        //echo $response->getBody();
        $date= $response->getBody();
//
//         $date=base64_decode($date);
         $priv_key=file_get_contents(storage_path('/key/www_priv.key'));
         $openssl_data=openssl_get_privatekey($priv_key);
         openssl_private_decrypt($date,$enc_data,$openssl_data);
         echo $enc_data;die;
     }
     public function sign(){
        $data="dj dj 我想要飞";
        $key='1911api';
        $sign=sha1($data.$key);
        $url="http://api.1911.com/sign?data=".$data."&sign=".$sign;
        $response=file_get_contents($url);
        echo $response;
     }
     public function aessign(){
        $data="123456";
        $key=file_get_contents(storage_path("key/www_priv.key"));

         $key1=openssl_get_privatekey($key);
        openssl_sign($data,$sign,$key1);
//        dd($sign);
        $sign=base64_encode($sign);
        $data=base64_encode($data);
//        dd($sign);
        $url="http://api.1911.com/aessign?data=".urlencode($data)."&sign=".urlencode($sign);

        $response=file_get_contents($url);6
        echo $response;
     }
}

