<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class loginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function login(Request $req)
    {
    	$email=$req->input('email');
    	$password=$req->input('password');

    	// $checkLogin = DB::table('login') -> where (['email']=>$email,['password']=>$password)->get();

    	if(count($checkLogin)>0)
    	{
    		return view('welcome');
    	}
    	else
    	{
    		echo "Login Failed";
    	}
    }
}
