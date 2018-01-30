<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class BDLoginController extends Controller
{
    //
     public function __construct()
    {
    	$this->middleware('guest:budgetdepartment');
    }
    public function showBDLogin()
    {
    	return view('auth.bdlogin');
    }

    public function BDlogin(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if(Auth::guard('budgetdepartment')->attempt(['email'=> $request->email, 'password' => $request->password], $request->remember))
    		{
    			return redirect()->intended(route('bd.home'));
    		}
    	return redirect()->back()->withInput($request->only('email','remember'));
    }
}
