<?php

namespace App\Http\Controllers\Auth;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class LogInController extends Controller
{
    public function login(){
        return view('auth.login');
    }
}
