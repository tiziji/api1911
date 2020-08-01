<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function reg(){
        return view("admin.reg");
    }
}
