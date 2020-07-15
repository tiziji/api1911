<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getAccessToken(){
        $appid="wx95226ae1641aa1b7";
        $secret="fd56081946fee7fbe0c53c7bdb5f3373";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        $res=file_get_contents($url);
        var_dump($res);
    }
}
