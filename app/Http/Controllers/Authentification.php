<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Authentification extends Controller
{
    public function login(){
        return View("auth.login") ;
    }
    public function register(){
        return View("auth.register") ;
    }
}
