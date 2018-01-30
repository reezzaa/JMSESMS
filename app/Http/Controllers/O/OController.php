<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:operations');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.O.o_home');
    }
    
}
