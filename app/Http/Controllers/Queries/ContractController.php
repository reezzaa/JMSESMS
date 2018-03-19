<?php

namespace App\Http\Controllers\Queries;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompClientRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Client;
use DB;
use Response;

class ContractController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:projectmanager');

    }
    public function index()
    {
        $contracts = \DB::table('tblcontract AS contract')
                        -> select('contract.id AS id', 'contract.name AS name', 
                                    'client.strCompClientName AS clientname', 'client.strCompClientID AS clientID',
                                    'contract.from AS from', 'contract.status as status')
                        -> join('tblclient AS client', 'contract.clientID', '=', 'client.strCompClientID')
                        -> get();
        
        return view('layouts.PM.queries.query_contract') -> with('contracts', $contracts);
    }
}