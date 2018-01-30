<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingCollectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        //
        return view('layouts.BD.transact.index');
    }

    public function readByAjax()
    {
        return view('layouts.BD.transact.table');
    }
   
    public function createBill()
    {
        return view('layouts.BD.transact.billing.index');
        
    }
    public function createCollect()
    {
        return view('layouts.BD.transact.collection.index');
        
    }
    // public function create()
    // {
    //     return view('layouts.BD.transact.bill.incurrences.index');
        
    // }

  
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
