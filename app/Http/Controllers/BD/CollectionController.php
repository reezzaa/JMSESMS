<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\Downpayment;
use App\ProgressBill;
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
        ->leftjoin('tblpayment','tblpayment.InvID','tblserviceinvoiceheader.id')
        ->select('tblserviceinvoiceheader.*','tblserviceinvoiceheader.id as inv','tblserviceinvoiceheader.date as s_date','tblpayment.*','tblpayment.date as p_date')
        ->where('tblcontract.id',$id)
        ->get();

        $detail =DB::table('tblserviceinvoiceheader')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->groupby('tblserviceinvoiceheader.id','tblserviceinvoicedetail.desc')
        ->select('tblserviceinvoicedetail.desc','tblserviceinvoiceheader.id as serv',DB::raw('SUM(tblserviceinvoicedetail.amount) as total' ))
        ->where('tblcontract.id',$id)
        // ->where('tblserviceinvoiceheader.id','Inv0000023')
        ->get();

       // dd($detail);
        

        $date = Carbon::now();
        foreach ($detail as $key ) {
                     $key->total=number_format($key->total,2);      
                    }       
        return view('layouts.BD.transact.collection.table',compact('colle','date','detail'));

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


        return redirect()->route('bd.printAckReceipt',$orid);


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

        return redirect()->route('bd.printAckReceipt',$orid);
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

       $bank = Bank::where('status',1)->where('todelete',1)->get();


        return view('layouts.BD.transact.collection.index',compact('coll','bank'));
        
    }
    public function printAckReceipt($id)
    {
        $getdata = Payment::join('tblserviceinvoiceheader','tblserviceinvoiceheader.id','tblpayment.InvID')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        // ->join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->join('tblbank','tblbank.id','tblpayment.BankID')
        ->select('tblclient.strCompClientName','tblserviceinvoicedetail.amount','tblserviceinvoiceheader.id as inv','tblpayment.cheque_no','tblpayment.date as v_date','tblpayment.BankID','tblbank.BankName')
        ->where('tblpayment.OrID',$id)
        ->get();

        foreach ($getdata as $key ) {
                     $key->amount=number_format($key->amount,2);
                    } 
         $pdf = PDF::loadView('layouts.BD.transact.collection.print_ac',compact('getdata'))->setPaper('letter','portrait');      
                
         $pdfName="myPDF.pdf";
                $location=public_path("docs/$pdfName");
                $pdf->save($location); 
        return $pdf->stream();   
    }

    public function printOR($id)
    {
        // $orid = $this->getIDOR();
        $getpayment = Payment::join('tblserviceinvoiceheader','tblserviceinvoiceheader.id','tblpayment.InvID')
        ->join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        // ->join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->join('tblbank','tblbank.id','tblpayment.BankID')
        ->select('tblclient.strCompClientName','tblclient.strCompClientTIN','tblclient.strCompClientAddress','tblclient.strCompClientCity','tblclient.strCompClientProv','tblserviceinvoicedetail.amount','tblserviceinvoiceheader.id as inv','tblserviceinvoicedetail.subtotal','tblpayment.cheque_no','tblpayment.date as v_date','tblpayment.BankID','tblbank.BankName')
        ->where('tblpayment.OrID',$id)
        ->get();

        $tax = 0;
        foreach ($getpayment as $v) {
            # code...
            $tax = $v->amount - $v->subtotal;
        }

        $utilities = CompanyUtil::all();
                     $tax=number_format($tax,2);      

         foreach ($getpayment as $key ) {
                     $key->amount=number_format($key->amount,2);
                     $key->subtotal=number_format($key->subtotal,2);
                    }       
        $pdf = PDF::loadView('layouts.BD.transact.collection.print',compact('getpayment','tax','utilities','id'))->setPaper('letter','portrait');      
                
         $pdfName="myPDF.pdf";
                $location=public_path("docs/$pdfName");
                $pdf->save($location); 
        return $pdf->stream();   


    }
   
    public function process($id)
    {
        //

        $proc = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->select('tblserviceinvoiceheader.*','tblserviceinvoicedetail.*')
        ->where('tblserviceinvoiceheader.id',$id)
        ->first();

        

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

        $chec =0;
        $chec = number_format($cheque->amount,2); 
       $bank = Bank::where('status',1)->where('todelete',1)->get();

       return view('layouts.BD.transact.collection.byCheque',compact('cheque','bank','chec'));
    }
    public function update(Request $request, $id)
    {
        

        $getdown = Contract::join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->select('tbldownpayment.id')
        ->where('tbldownpayment.status',0)
        ->where('tbldownpayment.ContractID',$id)
        ->first();

        $getprog = Contract::join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->select('tblprogressbill.id')
        ->where('tblprogressbill.ContractID',$id)
        ->where('tblprogressbill.status',0)
        ->orderBy('tblprogressbill.Mode','ASC')
        ->first();
        // dd($getdown)
        $getinv = Payment::where('OrID',$request->or)
        ->select('InvID')
        ->first();

        $check_mode = ServiceInvoiceHeader::where('id',$getinv->InvID)->where('mode',1)->first();

        $updcont = Contract::find($id);
        $updcont->active = 1;
        $updcont->save();
        if($check_mode==null)
        {
            $updpay = Payment::find($request->or);
            $updpay->isclear = 1;
            $updpay->save();
        }
        else
        {
            if($getdown==null && $getprog!=null)
            {
                $updprog = ProgressBill::find($getprog->id);
                $updprog->status = 1;
                $updprog->invoice = $getinv->InvID;
                $updprog->save(); 
            }
            elseif($getdown!=null)
            {
                $upddown = Downpayment::find($getdown->id);
                $upddown->status = 1;
                $upddown->invoice = $getinv->InvID;
                $upddown->save(); 

            } 
            
            $updpay = Payment::find($request->or);
            $updpay->isclear = 1;
            $updpay->save();
            
        }

        return Response($updpay);
        // return redirect()->route('bd.printOR',$request->or);


    }
    public function updIncur(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bouncePayment($id)
    {
        //
        $pay = Payment::where('OrID',$id)
        ->get();
        foreach ($pay as $key ) {
                     $key->amountpaid=number_format($key->amountpaid,2);
                    }       
        return Response($pay);
        
    }
    public function bouncePost(Request $request)
    {
        $bnc = Payment::find($request->b_or);
        $bnc->cheque_no = $request->cheque_no;
        $bnc->BankID = $request->bank;
        $bnc->save();

        return redirect()->route('bd.printAckReceipt',$request->b_or);
    }
}
