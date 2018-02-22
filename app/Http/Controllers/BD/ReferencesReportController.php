<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\CompanyUtil;
use Carbon\carbon;
use PDF;

class ReferencesReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $contracts = Contract::select('id as conid','name')
        ->get();

        return view('layouts.BD.reports.references.index',compact('contracts'));
    }

    public function printReferencesofBilling(Request $request)
    {
        // $utilities = CompanyUtil::all();
        $utilities = DB::table('tblCompanyUtil')
        ->select('tblCompanyUtil.*')
        ->first();
        
        $header = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->select('tblclient.strCompClientName','tblcontract.name','tblcontract.amount as c_amount')
        ->where('tblcontract.id',$request->project)
        ->first();
        // dd($request->project);

        $down = Contract::join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->select('tbldownpayment.amount as d_amount','tbldownpayment.status','tbldownpayment.initialtax','tbldownpayment.taxValue')
        ->where('tblcontract.id',$request->project)
        ->first();

        $pb = Contract::join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->join('tblprogressdetail','tblprogressdetail.PB_ID','tblprogressbill.id')
        ->select('tblprogressbill.amount as pb_amount','tblprogressbill.status','tblprogressbill.Mode','tblprogressdetail.*')
        ->where('tblcontract.id',$request->project)
        ->orderby('tblprogressbill.Mode','ASC')
        ->get();

        $invoice = Contract::join('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->select('tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.amount as s_amount','tblserviceinvoicedetail.subtotal','tblserviceinvoicedetail.desc')
        ->where('tblcontract.id',$request->project)
        ->whereBetween('tblserviceinvoiceheader.date',[$request->from,$request->to])
        ->get();
        
        $header->c_amount=number_format($header->c_amount,2);


        $down->d_amount=number_format($down->d_amount,2);
        $down->initialtax=number_format($down->initialtax,2);
        $down->taxValue=number_format($down->taxValue,2);


         foreach ($pb as $key ) {
            $key->pb_amount=number_format($key->pb_amount,2);
            $key->subtotal=number_format($key->subtotal,2);
            $key->taxValue=number_format($key->taxValue,2);
            $key->retValue=number_format($key->retValue,2);
            $key->recValue=number_format($key->recValue,2);
            $key->initial=number_format($key->initial,2);
            }
        foreach ($invoice as $inv ) {
            $inv->s_amount=number_format($inv->s_amount,2);
            $inv->subtotal=number_format($inv->subtotal,2);
           
            }


        $pdf = PDF::loadView('layouts.BD.reports.references.print',compact('utilities','header','down','pb','invoice'))->setPaper('legal','landscape');      
        
        $pdfName="myPDF.pdf";
        // $location=public_path("docs/$pdfName");
        // $pdf->save($location); 
        return $pdf->stream(); 


    }
   
}
