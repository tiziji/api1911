<?php

namespace App\Http\Controllers;

//use http\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class OauthController extends Controller
{
    public function git(){
        $code=$_GET['code'];
         dd($this->getToken($code));
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
                'redirect_uri'=>'8ae9fc2dd8df15aaff41602eae89135efff45229',
                'code'=>$code
            ]
        ]);
        $response_data=$response->getBody();
        echo $response_data;die;

        $token = "";
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
