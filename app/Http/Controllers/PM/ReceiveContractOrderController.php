<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use Carbon\carbon;
class ReceiveContractOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:projectmanager');

    }
    public function index()
    {
        //
        return view('layouts.PM.transact.receiveorder.index');
    }

    public function readByAjax()
    {
        $cont = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.strCompClientName')
        ->where('tblcontract.status',0)
        ->orderby('tblcontract.id','ASC')
        ->get();

        return view('layouts.PM.transact.receiveorder.table',compact('cont'));
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
