<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function index(){

        return view('panel.home');
    }




    public function logout(Request $request)
    {
        Auth::guard()->logout();
        return redirect()->route('panel.login');
    }
}
