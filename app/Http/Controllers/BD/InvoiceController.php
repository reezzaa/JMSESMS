<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceInvoiceHeader;
use App\CompanyUtil;
use PDF;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
         $print = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
                ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
                ->leftjoin('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
                ->join('tblclient','tblclient.id','tblcontract.ClientID')
                ->select('tblclient.*','tblcontract.*','tbldownpayment.taxValue','tblserviceinvoiceheader.*','tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount')
                ->where('tblserviceinvoiceheader.id',$id)
                ->get();
                foreach ($print as $key ) {
                     $key->amount=number_format($key->amount,2);
                     $key->subtotal=number_format($key->subtotal,2);
                     $key->taxValue=number_format($key->taxValue,2);      
                    }       
                // $date = Carbon::now();
                $utilities = CompanyUtil::all();
                $pdf = PDF::loadView('layouts.BD.transact.billing.print',compact('print','utilities','id'))->setPaper('letter','portrait');      
                
                $pdfName="myPDF.pdf";
                // $location=public_path("docs/$pdfName");
                // $pdf->save($location); 
                return $pdf->stream(); 

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
