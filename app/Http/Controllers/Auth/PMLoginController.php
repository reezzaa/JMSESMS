<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PMLoginController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('guest:projectmanager');
    }
    public function showPMLogin()
    {
    	return view('auth.pmlogin');
    }

    public function PMlogin(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if(Auth::guard('projectmanager')->attempt(['email'=> $request->email, 'password' => $request->password], $request->remember))
    	{
    		return redirect()->intended(route('pm.home'));
    	}
            return redirect()->back()->withInput($request->only('email','remember'));
        
    }
}
