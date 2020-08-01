<?php

namespace App\Http\Controllers;

//use http\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class OauthController extends Controller
{
    public function git(){
        $code=$_GET['code'];
         $as=$this->getToken($code);
         echo $as;die;
        echo '<pre>';print_r($_GET);echo '</pre>';
    }
    protected function getToken($code)
    {
        $url = 'https://github.com/login/oauth/access_token';

        //post 接口  Guzzle or  curl
        $client=new Client();
        $response=$client->request("POST",$url,[
            'form_params'=>[
                'client_id'=>'cdcf92fed2e888969fcb',
                'client_secret'=>'http://1911tzj.comcto.com/oauth/git',
                'code'=>$code
            ]
        ]);
       $responseData=$response->getBody();
        $token =$responseData['access_token'];
        dd($token);
        // 拿到token  获取用户信息

        $this->getGithubUserInfo($token);
    }


    protected function getGithubUserInfo($token)
    {
        $url = 'https://api.github.com/user?token='.$token;
        //GET 请求接口
         $client=new Client();
        $response = $client->request('GET', $url);
        $response_data=$response->getBody();
        echo $response_data;
    }
}
