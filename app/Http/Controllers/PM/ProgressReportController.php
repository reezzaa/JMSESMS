<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\CompanyUtil;
use DB;
use PDF;
class ProgressReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:projectmanager');
    }
    public function index()
    {
        $contract = Contract::select('id as conid','name')
        ->where('status',1)
        ->get();

        return view('layouts.PM.reports.progress.index',compact('contract'));
    }

    
    public function printProgress(Request $request)
    {
        $from=$request->from;
        $to=$request->to;
        $null='';

        $utilities = CompanyUtil::all();

        $print = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->select('tblservtask.ServTask','tblcontracttask.wt','tblduedetail.percent','tblduedetail.date')
        ->where('tblcontracttask.status','!=',2)
        ->where('tblcontract.id',$request->contract)
        ->whereBetween('tblduedetail.date',[$request->from,$request->to])
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        // ->groupby('tblservtask.id','tblcontract.name','tblservtask.ServTask','tblcontracttask.wt','tblduedetail.percent','tblduedetail.date')
        ->get();

        $header = Contract::join('tblcontractorder','tblcontractorder.ContractID','tblcontract.id')
        ->select('tblcontract.name','tblcontractorder.co')
        ->where('tblcontract.id',$request->contract)
        ->get();

        // dd($print);

        $pdf = PDF::loadView('layouts.PM.reports.progress.print',compact('utilities','header','print','null','from','to'))->setPaper('letter','portrait');      
        
        $pdfName="myPDF.pdf";
        $location=public_path("docs/$pdfName");
        $pdf->save($location); 
        return $pdf->stream(); 
    }

    
}
