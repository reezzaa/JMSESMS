<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\Downpayment;
use Carbon\carbon;
use App\ServiceInvoiceHeader;
use App\Bank;
use App\Payment;
use App\CompanyUtil;
use DB;
use PDF;
use Response;
class CollectionController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        //
    }

    public function readByAjax($id)
    {
        $colle = Contract::join('tblserviceinvoiceheader','tblserviceinvoiceheader.ContractID','tblcontract.id')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->leftjoin('tblpayment','tblpayment.InvID','tblserviceinvoiceheader.id')
        ->select('tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as inv','tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.*','tblpayment.*','tblpayment.date as p_date')
        ->where('tblcontract.id',$id)
        ->get();

        $date = Carbon::now();
        foreach ($colle as $key ) {
                     $key->amount=number_format($key->amount,2);      
                    }       
        return view('layouts.BD.transact.collection.table',compact('colle','date'));

    }

     public function getORPattern()
    {
        $id = DB::table('tblOrIDUtil')->get();
        foreach($id as $id)
        {
            return $id->strOrIDUtil;
        }
    }

    public function getLastORPattern()
    {
        $id = DB::table('tblPayment')
        ->select('tblPayment.OrID')
        ->orderBy('tblPayment.OrID','desc')
        ->first();
        foreach($id as $id)
        {
            return $id;
            // dd($id);
        }
    }
    public function Splits($text)
    {
        $returnText = '';
        for ($i = 0; $i < strlen($text)-1; $i++)
        {
            if (ctype_alnum($text[$i]))
            {
                if ((ctype_alpha($text[$i]) && ctype_digit($text[$i+1])) || 
                    (ctype_digit($text[$i]) && ctype_alpha($text[$i+1])) && ctype_alnum($text[$i+1]))
                {
                    $returnText .= $text[$i];
                    $returnText .= ' ';
                }
                else
                {
                    $returnText .= $text[$i];
                }
            }
            else
            {
                if (ctype_alnum($text[$i-1]) && !(ctype_alnum($text[$i+1])))
                {
                    $returnText .= ' ';
                    $returnText .= $text[$i];
                }
                else if (ctype_alnum($text[$i-1]) && (ctype_alnum($text[$i+1])))
                {
                    $returnText .= ' ';
                    $returnText .= $text[$i];
                    $returnText .= ' ';
                }
                else if (!(ctype_alnum($text[$i])) && ctype_alnum($text[$i+1]))
                {
                    $returnText .= $text[$i];
                    $returnText .= ' ';
                }

                else
                {
                    $returnText .= $text[$i];
                }
            }
        }
        $returnText .= $text[(strlen($text))-1];
        return $returnText;
    }  

    public function Incremented($text)
    {
        $returnIncText = '';
        $incrementNext = 0;
        $dont_incrementNext = 0;
        //string to array
        $tokens = explode(' ', $text);
        //array size
        $tokens_size = sizeof($tokens);
        ///
        for ($i=$tokens_size-1; $i >= 0; $i--) { 
            //digit or not
            if(ctype_digit($tokens[$i]) && $dont_incrementNext == 0)
            {
                //string size
                $str_size = strlen($tokens[$i]);
                //increment
                $tokens[$i]++;
                if($incrementNext > 0 && $str_size > strlen($tokens[$i]))
                {
                    $tokens[$i] = str_pad($tokens[$i], $str_size, '0', STR_PAD_LEFT);
                    $dont_incrementNext++;
                    continue;
                }
                //size is smaller may zero sa unahan
                if($incrementNext == '' && $str_size > strlen($tokens[$i]))
                {
                    $tokens[$i] = str_pad($tokens[$i], $str_size, '0', STR_PAD_LEFT);
                    $incrementNext = '';
                    $dont_incrementNext++;
                }
                //equal
                else if($str_size == strlen($tokens[$i]))
                {
                    $tokens[$i] = str_pad($tokens[$i], $str_size, '0', STR_PAD_LEFT);
                    $incrementNext = '';
                    $dont_incrementNext++;
                }
                //size is larger
                else
                {
                    $tokens[$i] = str_pad('', $str_size, '0', STR_PAD_LEFT);
                    $incrementNext++;
                }
            }
        }
        for ($i=0; $i < sizeof($tokens); $i++)
        {
            $returnIncText .= $tokens[$i];
        }
        return $returnIncText;
    }



    public function getIDOR()
    {
        $scanEmp = Payment::all();
        if($scanEmp->count() == 0)
        {
            $splitID = $this->Splits($this->getORPattern());
            $incrementedID = $this->Incremented($splitID);
            $orid = $incrementedID;
            return $orid;
        }
        else
        {
            $splitID = $this->Splits($this->getLastORPattern());
            $incrementedID = $this->Incremented($splitID);
            $orid = $incrementedID;
            return $orid;
        }

    }
    
    public function store(Request $request)
    {
        //
        $now = Carbon::now();
        $now->addDays($request->val);
        $val_date = $now;

        $orid = $this->getIDOR();

        $payment = new Payment();
        $payment->OrID = $orid;
        $payment->InvID = $request->invno;
        $payment->amountpaid = $request->amtt;
        $payment->date = Carbon::now();
        $payment->change = null;
        $payment->remarks = $request->remarks;
        $payment->cheque_no = $request->cheque_no;
        $payment->BankID = $request->bank;
        $payment->validity = $val_date;
        $payment->isclear = 0;
        $payment->save();

        $updinv = ServiceInvoiceHeader::find($request->invno);
        $updinv->status = 1;
        $updinv->save();

        $getcont = ServiceInvoiceHeader::join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->select('tblcontract.id as conid')
        ->where('tblserviceinvoiceheader.id',$request->invno)
        ->first();
 
        $updcont = Contract::find($getcont->conid);
        $updcont->status = 1;
        $updcont->save();


        return redirect()->route('bd.printOR',$orid);


    }
    public function collectcash(Request $request)
    {
        $now = Carbon::now();
       

        $orid = $this->getIDOR();

        $payment = new Payment();
        $payment->OrID = $orid;
        $payment->InvID = $request->invno;
        $payment->amountpaid = $request->paymentcost;
        $payment->date = Carbon::now();
        $payment->change = $request->changed;
        $payment->remarks = $request->remarks;
        $payment->cheque_no = null;
        $payment->BankID = null;
        $payment->validity = null;
        $payment->isclear = 1;
        $payment->save();

        $updinv = ServiceInvoiceHeader::find($request->invno);
        $updinv->status = 1;
        $updinv->save();

        $getcont = ServiceInvoiceHeader::join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->select('tblcontract.id as conid')
        ->where('tblserviceinvoiceheader.id',$request->invno)
        ->first();

    
        $updcont = Contract::find($getcont->conid);
        $updcont->status = 1;
        $updcont->save();

        return redirect()->route('bd.printOR',$orid);
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
        $coll = Contract::where('id',$id)
        ->first();

        return view('layouts.BD.transact.collection.index',compact('coll'));
        
    }

    public function printOR($id)
    {
        // $orid = $this->getIDOR();
        $getpayment = Payment::join('tblserviceinvoiceheader','tblserviceinvoiceheader.id','tblpayment.InvID')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->join('tblbank','tblbank.id','tblpayment.BankID')
        ->select('tblclient.strCompClientName','tblclient.strCompClientTIN','tblclient.strCompClientAddress','tblclient.strCompClientCity','tblclient.strCompClientProv','tblserviceinvoicedetail.amount','tblserviceinvoiceheader.id as inv','tblserviceinvoicedetail.subtotal','tbldownpayment.initialtax','tbldownpayment.taxValue','tblpayment.cheque_no','tblpayment.date as v_date','tblpayment.BankID','tblbank.BankName')
        ->where('tblpayment.OrID',$id)
        ->get();

        $utilities = CompanyUtil::all();

         foreach ($getpayment as $key ) {
                     $key->amount=number_format($key->amount,2);
                     $key->subtotal=number_format($key->subtotal,2);
                     $key->taxValue=number_format($key->taxValue,2);      
                    }       
        $pdf = PDF::loadView('layouts.BD.transact.collection.print',compact('getpayment','utilities','id'))->setPaper('letter','portrait');      
                
         $pdfName="myPDF.pdf";
                // $location=public_path("docs/$pdfName");
                // $pdf->save($location); 
        return $pdf->stream();   


    }
   
    public function process($id)
    {
        //

        $proc = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->select('tblserviceinvoiceheader.*','tblserviceinvoicedetail.*')
        ->where('tblserviceinvoiceheader.id',$id)
        ->get();

        return view('layouts.BD.transact.collection.collect',compact('proc'));
    }

    public function byCash($id)
    {
       $cash = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
       ->select('tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as inv','tblserviceinvoicedetail.*')
       ->where('tblserviceinvoiceheader.id',$id)
       ->first();

       return view('layouts.BD.transact.collection.byCash',compact('cash'));
    }
    public function byCheque($id)
    {
       $cheque = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
       ->select('tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as inv','tblserviceinvoicedetail.*')
       ->where('tblserviceinvoiceheader.id',$id)
       ->first();

       $bank = Bank::where('status',1)->where('todelete',1)->get();

       return view('layouts.BD.transact.collection.byCheque',compact('cheque','bank'));
    }
    public function update(Request $request, $id)
    {
        
        $getdown = Contract::join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->select('tbldownpayment.id')
        ->where('tbldownpayment.ContractID',$id)
        ->first();
        // dd($getdown)

        $updcont = Contract::find($id);
        $updcont->active = 1;
        $updcont->save();

        $upddown = Downpayment::find($getdown->id);
        $upddown->status = 1;
        $upddown->save();

        $updpay = Payment::find($request->or);
        $updpay->isclear = 1;
        $updpay->save();

        return Response($updpay);

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
