<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public function git(){
        $code=$_GET['code'];
       $this->getToken($code);
        echo '<pre>';print_r($_GET);echo '</pre>';
    }
    protected function getToken($code)
    {
        $url = 'https://github.com/login/oauth/access_token';

        //post 接口  Guzzle or  curl
        $token = "";
        // 拿到token  获取用户信息

        $this->getGithubUserInfo($token);
    }


    protected function getGithubUserInfo($token)
    {
        $url = 'https://api.github.com/user';
        //GET 请求接口
    }
}
