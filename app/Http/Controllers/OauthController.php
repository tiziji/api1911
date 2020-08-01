<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public function git(){
        $code=$_GET['code'];
        dd($code);
    }
}
