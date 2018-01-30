<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Operations;
use Response;
class OLoginController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('guest:operations');
    }
    public function showOLogin()
    {
    	return view('auth.ologin');
    }

    public function Ologin(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required'
    	]);

    	if(Auth::guard('operations')->attempt(['email'=> $request->email, 'password' => $request->password], $request->remember))
    		{
    			return redirect()->intended(route('o.home'));
    		}
    	return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function getLogout()
    {
        $this->middleware('guest:operations')->logout();
        // Auth::guard('operations')->logout();
        \Session::flash('flash_logout_success','Success!');
        return redirect()->intended(route('o.login'));
    }
    public function showRegister()
    {
        return view('auth.oregister');
    }
    public function register(Request $request)
    {
        $var = new Operations();
        $var->username = $request->val_username;
        $var->fname = $request->fname;
        $var->mname = $request->mname;
        $var->lname = $request->lname;
        $var->suffix = $request->suffix;
        $var->email = $request->email;
        $var->password = bcrypt($request->val_password);
        $var->active = 0;
        $var->status = 0;
        $var->theme = 'css/themes/spring.css';
        $var->remember_token = str_random(10);
        $var->save();

        return response::json($var);

    }
    public function theme(Request $request, $id)
    {
        $change = Operations::find($id);
        $change->theme= $request->stat;
        $change->save();

        return response::json($change);
    }
}
