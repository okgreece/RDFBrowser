<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BrowserController extends Controller
{
    public function browser(){
        return view('welcome');
    }
}