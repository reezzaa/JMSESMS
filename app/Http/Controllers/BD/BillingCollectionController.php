<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyUtil;
use DB;
use App\ServiceInvoiceHeader;
use App\Client;
use App\Contract;
use Carbon\carbon;
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
        $var = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        // ->where('tblcontract.status','!=',0)
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.strCompClientName')
        ->get();

        foreach ($var as $key ) {
             $key->amount=number_format($key->amount,2);
                
            }

        return view('layouts.BD.transact.table', compact('var'));
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
