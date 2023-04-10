<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class logoutController extends Controller
{
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('home_page');
    }
}
