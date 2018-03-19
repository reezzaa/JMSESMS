<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyUtil;
use App\ServiceInvoiceHeader;
use App\Contract;
use DB;
use PDF;

class CollectionReportController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        return view('layouts.BD.reports.collection.index');
    }
 
    public function printCollection(Request $request)
    {
        //
        $from=$request->from;
        $to=$request->to;
        $null='';

        $utilities = CompanyUtil::all();

        $proj = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvID')
        ->leftjoin('tblPayment','tblPayment.InvID','tblserviceinvoiceheader.id')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblcontractorder','tblcontractorder.ContractID','tblcontract.id')
        ->select('tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as serv_id','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount','tblserviceinvoiceheader.date as s_date','tblPayment.date as p_date','tblPayment.*','tblcontract.id as con_id','tblclient.strCompClientName','tblcontractorder.co','tblcontract.term','tblcontract.termdate')
        ->whereBetween('tblserviceinvoiceheader.date',[$request->from,$request->to])
        ->get();
            // dd($proj);

        $total = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvId')
        ->leftjoin('tblPayment','tblPayment.InvID','tblserviceinvoiceheader.id')
        ->whereBetween('tblserviceinvoiceheader.date',[$request->from,$request->to])
        ->sum('tblserviceinvoicedetail.amount');

        $collected = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvId')
        ->leftjoin('tblPayment','tblPayment.InvID','tblserviceinvoiceheader.id')
        ->whereBetween('tblserviceinvoiceheader.date',[$request->from,$request->to])
        ->where('tblserviceinvoiceheader.status',1)
        ->sum('tblserviceinvoicedetail.amount');

        $amount_tobe = $total - $collected;

        $down = Contract::join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        // ->leftjoin('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id')
        // ->join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvID')
        ->select('tbldownpayment.*','tblcontract.id as c_id'/*,'tblserviceinvoicedetail.amount as inv_amount'*/)
        ->get();
        // dd($down);

        $pb =  Contract::join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->join('tblprogressdetail','tblprogressdetail.PB_ID','tblprogressbill.id')
        // ->join('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id')
        // ->join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvID')
        ->select('tblprogressbill.*','tblprogressbill.amount as pb_amount','tblprogressdetail.*',/*'tblserviceinvoiceheader.id as inv_id',*/'tblcontract.id as c_id'/*,'tblserviceinvoicedetail.amount as inv_amount'*/)
        // ->where('tblprogressbill.status',1)
        // ->where('tblprogressbill.amount','14634.35')
        ->get();
        $inc =  Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        // ->leftjoin('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id')
        // ->join('tblserviceinvoicedetail','tblserviceinvoiceheader.id','tblserviceinvoicedetail.InvID')
        ->select('tblincurrences.amount as inc__amount','tblincurrences.*',/*'tblprogressdetail.*',*//*'tblserviceinvoiceheader.id as inv_id',*/'tblcontract.id as c_id'/*,'tblserviceinvoicedetail.amount as inv_amount'*/)
        ->get();

        // dd($down);
        $total=number_format($total,2);
        $collected=number_format($collected,2);
        $amount_tobe=number_format($amount_tobe,2);

             foreach ($proj as $p) {
            $p->s_amount=number_format($p->s_amount,2);
            }
         foreach ($down as $s) {
            // $s->amount=number_format($s->amount,2);
            $s->initialtax=number_format($s->initialtax,2);
            $s->taxValue=number_format($s->taxValue,2);
            }
        foreach ($pb as $k) {
            $k->initialtax=number_format($k->initialtax,2);
            $k->taxValue=number_format($k->taxValue,2);
            $k->retValue=number_format($k->retValue,2);
            $k->recValue=number_format($k->recValue,2);
            }


        $pdf = PDF::loadView('layouts.BD.reports.collection.print',compact('utilities','proj','total','collected','amount_tobe','down','pb','null','from','to','inc'))->setPaper('legal','landscape');      
        
        $pdfName="myPDF.pdf";
        $location=public_path("docs/$pdfName");
        $pdf->save($location); 
        return $pdf->stream(); 
    }

   
   
}
