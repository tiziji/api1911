<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class LoginController extends Controller
{
    public function login(){
        if(request()->isMethod('post')){
          $username=request()->post("username");
          $pwd=request()->post("pwd");
          $this->emptyUsername($username);    //验证账号
          $this->emptyPwd($pwd);              //验证密码
          $data=[
                'username'=>$username,
                'pwd'=>$pwd
            ];
          $encrypt=$this->encryptData($data);           //将账号密码加密
          $sign=$this->signData($data);              //做签名
            $arr=[
              'encrypt'=>base64_encode($encrypt),
              'sign'=>$sign
            ];
            //dd($arr);
            $arr1=$this->sendData($arr); //发送请求
            echo $arr1;
        }else{

            return view("admin.login");
        }
    }
    //验证用户名
   public function emptyUsername($username){
        if(empty($username)){
            $this->fail("请输入账号");
        }
   }
   //验证密码
   public function emptyPwd($pwd){
        if(empty($pwd)){
          $this->fail("请输入密码");
        }
   }
    //验证账号或密码返回的字符串
    public function fail($msg,$errno=1,$data=[]){
        echo json_encode($this->response($msg,$errno,$data),JSON_UNESCAPED_UNICODE);
    }
    //转换成数组
   public function response($msg,$errno,$data){
        return $arr=[
            'msg'=>$msg,
            'errno'=>$errno,
            'data'=>$data
        ];
   }
   //将账号密码加密  (对称加密)
   public function encryptData($data){
       $data1=json_encode($data);
        $key=env('OPENSSL_KEY');
       $iv=env('OPENSSL_IV');
      return  openssl_encrypt($data1,"AES-256-CBC",$key,OPENSSL_RAW_DATA,$iv);
   }
   //签名
    public function signData($data){
        $data=json_encode($data);
        $key=env('SIGN_KEY');
        $sign=sha1($data.$key);
         return $sign;
    }
    //发送请求
    public function sendData($data){
       $url="http://api.1911.com/login";
        $client=new Client();
        $response=$client->request("POST",$url,[
            'form_params'=>[
                'data'=>$data
            ]
        ]);
        echo $response->getBody();
    }
}
