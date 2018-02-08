<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyUtil;
use DB;
use App\ServiceInvoiceHeader;
use App\ServiceInvoiceDetail;
use App\Client;
use App\Contract;
use App\ContractTask;
use App\Downpayment;
use Carbon\carbon;
use PDF;
class BillingController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
     public function getEmpPattern()
    {
        $id = DB::table('tblInvoiceIDUtil')->get();
        foreach($id as $id)
        {
            return $id->strInvoiceIDUtil;
        }
    }

    public function getLastPattern()
    {
        $id = DB::table('tblServiceInvoiceHeader')
        ->select('tblServiceInvoiceHeader.id')
        ->orderBy('tblServiceInvoiceHeader.id','desc')
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

    public function getID()
    {
        $scanEmp = ServiceInvoiceHeader::all();
        if($scanEmp->count() == 0)
        {
            $splitID = $this->Splits($this->getEmpPattern());
            $incrementedID = $this->Incremented($splitID);
            $invoiceid = $incrementedID;
            return $invoiceid;
        }
        else
        {
            $splitID = $this->Splits($this->getLastPattern());
            $incrementedID = $this->Incremented($splitID);
            $invoiceid = $incrementedID;
            return $invoiceid;
        }

    }
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

    public function readByAjax($id)
    {
        $tasktable = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblduewt','tblduewt.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->select('tblservtask.ServTask','tblservtask.total','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.progress','tblduewt.wt')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->get();
        foreach ($tasktable as $key ) {
             $key->total=number_format($key->total,2);

             $key->progress = ($key->progress/$key->wt)*100;
            }
            // dd($tasktable);
        

        return view('layouts.BD.transact.billing.table',compact('tasktable'));
    }
    public function store(Request $request)
    {
        //
         $invoiceid = $this->getID();

            $Targ =Carbon::now();
            $getTarg = Carbon::parse($Targ);

            if($request->termdate=='days')
            {
                 $getTarg->addDays($request->term);
                $bill = new ServiceInvoiceHeader();
                $bill->id=$invoiceid;
                $bill->ContractID=$request->ContractID;
                $bill->date=$Targ;
                $bill->status=0;
                $bill->duedate=$getTarg;
                $bill->save();
            }
            elseif($request->termdate=='month')
            {
                if($request->term==1)
                {
                    $getTarg->addMonth();
                    $bill = new ServiceInvoiceHeader();
                    $bill->id=$invoiceid;
                    $bill->ContractID=$request->ContractID;
                    $bill->date=$Targ;
                    $bill->status=0;
                    $bill->duedate=$getTarg;
                    $bill->save();

                }
                elseif($request->term>1)
                {
                    $getTarg->addMonths($request->term);
                    $bill = new ServiceInvoiceHeader();
                    $bill->id=$invoiceid;
                    $bill->ContractID=$request->ContractID;
                    $bill->date=$Targ;
                    $bill->status=0;
                    $bill->duedate=$getTarg;
                    $bill->save();
                }
            }
            elseif($request->termdate=='year')
            {
                if($request->term==1)
                {
                    $getTarg->addYear();
                    $bill = new ServiceInvoiceHeader();
                    $bill->id=$invoiceid;
                    $bill->ContractID=$request->ContractID;
                    $bill->date=$Targ;
                    $bill->status=0;
                    $bill->duedate=$getTarg;
                    $bill->save();

                }
                elseif($request->term>1)
                {
                    $getTarg->addYears($request->term);
                    $bill = new ServiceInvoiceHeader();
                    $bill->id=$invoiceid;
                    $bill->ContractID=$request->ContractID;
                    $bill->date=$Targ;
                    $bill->status=0;
                    $bill->duedate=$getTarg;
                    $bill->save();
                }
            }   

                $billdetail= new ServiceInvoiceDetail();
                $billdetail->InvID=$invoiceid;
                $billdetail->amount=$request->amount;
                $billdetail->subtotal=$request->subtotal;
                $billdetail->desc=$request->desc;
                $billdetail->save();

                

                // return Response($bill);
                return redirect()->route('bd.printInvoice',$invoiceid);
                


    }
    public function printInvoice($id)
    {
       $print = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
                ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
                ->leftjoin('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
                ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
                ->select('tblclient.strCompClientName','tblclient.strCompClientAddress','tblclient.strCompClientCity','tblclient.strCompClientProv','tblclient.strCompClientTIN','tblcontract.term','tblcontract.termdate','tbldownpayment.taxValue','tblserviceinvoiceheader.*','tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount')
                ->where('tblserviceinvoiceheader.id',$id)
                ->get();
                // dd($print);
                foreach ($print as $key ) {
                     $key->s_amount=number_format($key->s_amount,2);
                     $key->subtotal=number_format($key->subtotal,2);
                     $key->taxValue=number_format($key->taxValue,2);      
                    }       
                $utilities = CompanyUtil::all();
                $pdf = PDF::loadView('layouts.BD.transact.billing.print',compact('print','utilities','id'))->setPaper('letter','portrait');      
                
                $pdfName="myPDF.pdf";
                // $location=public_path("docs/$pdfName");
                // $pdf->save($location); 
                return $pdf->stream();   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInvoice($id)
    {
       
        return view('layouts.BD.transact.billing.current', compact());


    }

    public function show($id)
    {
        //
      
        $contract = Contract::join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->select('tblcontract.*','tblcontract.id as conid','tbldownpayment.amount as down_amount','tbldownpayment.*','tbldownpayment.status as d_status')
        ->where('tblcontract.id',$id)
        ->get();
        $down = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->where('tblcontract.id',$id)
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.*','tbldownpayment.amount as down_amount','tbldownpayment.*','tbldownpayment.status as down_status')
        ->get();
        foreach ($down as $key ) {
             $key->amount=number_format($key->amount,2);
             $key->down_amount=number_format($key->down_amount,2);
             $key->initialtax=number_format($key->initialtax,2);
             $key->taxValue=number_format($key->taxValue,2);
                
            }  
        $down1 = Downpayment::select('tbldownpayment.*')
        ->first();     
        $date = Carbon::now();
        $utilities = CompanyUtil::all();
        $invoiceid = $this->getID();

        $com = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->sum('tblduedetail.progress');


        return view('layouts.BD.transact.billing.index', compact('contract','down','date','utilities','invoiceid','down1','id','com'));
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
