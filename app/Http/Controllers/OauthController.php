<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public function git(){
        dd(request()->all());
    }
}
