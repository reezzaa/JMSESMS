<?php

namespace App\Http\Controllers\Queries;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompClientRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Client;
use DB;
use Response;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $invoices = \DB::table('tblserviceinvoiceheader AS invoicehead')
                        -> select('invoicehead.id AS id', 'invoicehead.date AS date', 
                                    'invoicedetail.amount AS amount', 
                                    'client.strCompClientName AS clientname', 'client.strCompClientID as clientID',
                                    'contract.ClientID AS contractClientID')
                        -> join('tblserviceinvoicedetail AS invoicedetail', 'invoicedetail.InvID', '=', 'invoicehead.id')
                        -> join('tblcontract AS contract', 'contract.id', '=', 'invoiceHead.ContractID')
                        -> join('tblClient AS client', 'client.strCompClientID', '=', 'contract.ClientID')
                        -> get();
        
        return view('layouts.BD.queries.query_invoice') -> with('invoices', $invoices);
    }
}