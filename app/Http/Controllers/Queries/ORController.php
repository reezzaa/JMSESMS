<?php

namespace App\Http\Controllers\Queries;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompClientRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Client;
use DB;
use Response;

class ORController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $receipts = \DB::table('tblpayment AS payment')
                        -> select('payment.OrID AS id', 'payment.amountPaid AS paid', 
                                    'payment.date AS date', 'contract.name AS name', 
                                    'contract.id AS contractID')
                        -> join('tblserviceinvoiceheader AS invoicehead', 'invoicehead.id', '=', 'payment.InvID')
                        -> join('tblcontract AS contract', 'contract.id', '=', 'invoicehead.ContractID')
                        -> get();
        
        return view('layouts.BD.queries.query_order') -> with('receipts', $receipts);
    }
}