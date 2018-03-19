<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyUtil;
use App\ServiceInvoiceHeader;
use App\Client;
use DB;
use PDF;
class SOAReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $client = Client::join('tblcontract','tblcontract.ClientID','tblclient.strCompClientID')
        ->where('tblclient.status',1)
        ->where('tblclient.todelete',1)
        ->groupby('tblclient.strCompClientID','tblclient.strCompClientName')
        ->select('tblclient.strCompClientName','tblclient.strCompClientID')  
        ->get();      

        return view('layouts.BD.reports.soa.index',compact('client'));
    }
    
    public function printSOA(Request $request)
    {
        $from=$request->from;
        $to=$request->to;
        $null='';

        $clients= Client::select('strCompClientName')
        ->where('strCompClientID',$request->client)
        ->first();
        // dd($request->client);

        $soa = Client::join('tblcontract','tblcontract.ClientID','tblclient.strCompClientID')
        ->join('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id') 
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id') 
        ->leftjoin('tblpayment','tblpayment.InvID','tblserviceinvoiceheader.id') 
        ->where('tblclient.strCompClientID',$request->client)
        ->wherebetween('tblserviceinvoiceheader.date',[$request->from,$request->to])
        ->select('tblclient.strCompClientName','tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as serv_id','tblserviceinvoiceheader.date as s_date','tblserviceinvoiceheader.status as s_status','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount','tblcontract.id as con_id','tblcontract.*','tblpayment.OrID')
        ->get();

        $utilities = CompanyUtil::all();

        foreach ($soa as $s) {
            $s->s_amount=number_format($s->s_amount,2);
            }
        $pdf = PDF::loadView('layouts.BD.reports.soa.print',compact('utilities','clients','soa','null','from','to'))->setPaper('letter','portrait');      
        
        $pdfName="myPDF.pdf";
        $location=public_path("docs/$pdfName");
        $pdf->save($location); 
        return $pdf->stream(); 
    }

}
