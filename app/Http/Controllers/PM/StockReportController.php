<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\CompanyUtil;
use App\ServMaterial;
use DB;
use PDF;
class StockReportController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:projectmanager');

    }
    public function index()
    {
        //
        return view('layouts.PM.reports.stock.index');
    }

   
    public function printStockUsage(Request $request)
    {
        //
         $from=$request->from;
        $to=$request->to;
        $null='';

        $utilities = CompanyUtil::all();

        $print = DB::table('tblcontract')
        ->where('tblcontract.status','!=',3)
        ->whereBetween('tblcontract.from',[$request->from,$request->to])
        // ->whereBetween('tblcontract.to',[$request->from,$request->to])
        ->select('tblcontract.id as con_id','tblcontract.name')
        ->get();

        $print_details = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblstocks','tblstocks.ServMatID','tblservmaterial.id')
        ->where('tblcontract.status','!=',3)
        ->where('tblcontracttask.active','!=',2)
        // ->whereBetween('tblcontract.from',[$request->from,$request->to])
        ->select('tblcontract.id as c_id','tblservtask.ServTask','tblservmaterial.id as s_id')
        ->get();

        $mats = DB::table('tblservmaterial')
        ->join('tblservtask','tblservtask.id','tblservmaterial.ServID')
        ->join('tblcontracttask','tblcontracttask.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.id')
        ->groupby('tblservtask.id','tblmaterial.MaterialName','tblservmaterial.id')
        ->select( 'tblmaterial.MaterialName','tblservmaterial.id as s_id')
        ->get();
        
        $stock = DB::table('tblservmaterial')
        ->join('tblservtask','tblservtask.id','tblservmaterial.ServID')
        ->join('tblcontracttask','tblcontracttask.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.id')
        ->where('tblcontracttask.active','!=',2)
        ->leftjoin('tbltaskmat','tbltaskmat.TaskID','tblcontracttask.id')
        ->groupby('tblservmaterial.quantity','tbltaskmat.quantity','tblmaterial.MaterialName','tblservmaterial.id')
        ->select( DB::raw('(SUM(tblservmaterial.quantity)+ tbltaskmat.quantity) as quantity '),'tblmaterial.MaterialName','tblservmaterial.id as s_id')
        ->get();
        
        // dd($print);

        $pdf = PDF::loadView('layouts.PM.reports.stock.print',compact('utilities','print','print_details','mats','stock','from','to'))->setPaper('letter','portrait');      
        
        $pdfName="myPDF.pdf";
        $location=public_path("docs/$pdfName");
        $pdf->save($location); 
        return $pdf->stream();
    }

  
}
