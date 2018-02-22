<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyUtil;
use DB;
use App\ServiceInvoiceHeader;
use App\ServiceInvoiceDetail;
use App\Client;
use App\ServTask;
use App\DueDetail;
use App\Contract;
use App\ContractTask;
use App\Downpayment;
use App\ProgressBill;
use Carbon\carbon;
use PDF;
use Response;
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
        $tasktable = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        ->select('tblservtask.ServTask','tblservtask.total as s_total','tblservtask.id as serv_id','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.progress','tblcontracttask.wt','tblcontracttask.id as task_id','tblduedetail.percent','tblcontracttask.status as ct_status','tblincurrences.method')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->orderby('tblcontracttask.id','ASC')
        ->get();
        // dd($tasktable);
        // $paid_incur = DB::table('tblcontract')
        // ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        // ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        // ->where('tblcontract.id',$id)
        // ->groupby('tblcontracttask.id','tblservtask.total')
        // ->where('tblincurrences.status',1)
        // ->select(DB::raw('(SUM(tblincurrences.amount) + tblservtask.total) as paidamount'),'tblcontracttask.id as pt_id')
        // ->get();

        $incur = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        // ->where('tblincurrences.status',0)
        ->groupby('tblcontracttask.id','tblservtask.total','tblincurrences.status')
        ->select(DB::raw('SUM(tblincurrences.amount) as incur_amount'),DB::raw('(SUM(tblincurrences.amount) + tblservtask.total) as paidamount'),'tblcontracttask.id as t_id','tblincurrences.status')
        ->get();
        
        

        // dd($count_incur);

        foreach ($tasktable as $key ) {
             $key->s_total=number_format($key->s_total,2);

             // $key->progress = ($key->progress/$key->wt)*100;
            }
        foreach ($incur as $hehe ) {
             $hehe->incur_amount=number_format($hehe->incur_amount,2);

             // $key->progress = ($key->progress/$key->wt)*100;
            }
        // foreach ($paid_incur as $he ) {
        //      $he->paidamount=number_format($he->paidamount,2);

        //      // $key->progress = ($key->progress/$key->wt)*100;
        //     }
            // dd($tasktable);
        

        return view('layouts.BD.transact.billing.table',compact('tasktable','incur'));
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
        ->join('tbldownpayment','tbldownpayment.ContractID','tblcontract.id')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->select('tblclient.strCompClientName','tblclient.strCompClientAddress','tblclient.strCompClientCity','tblclient.strCompClientProv','tblclient.strCompClientTIN','tblcontract.term','tblcontract.termdate','tbldownpayment.taxValue','tblserviceinvoiceheader.*','tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount')
        ->where('tblserviceinvoiceheader.id',$id)
        ->where('tbldownpayment.status',0)
        ->get();

        $print_prog_bill = ServiceInvoiceHeader::join('tblserviceinvoicedetail','tblserviceinvoicedetail.InvID','tblserviceinvoiceheader.id')
        ->join('tblcontract','tblcontract.id','tblserviceinvoiceheader.ContractID')
        ->join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblprogressdetail','tblprogressdetail.PB_ID','tblprogressbill.id')
        ->where('tblserviceinvoiceheader.id',$id)
        // ->where('tblprogressbill.status',0)
        ->orderby('tblprogressbill.Mode','ASC')
        ->select('tblclient.strCompClientName','tblclient.strCompClientAddress','tblclient.strCompClientCity','tblclient.strCompClientProv','tblclient.strCompClientTIN','tblcontract.term','tblcontract.termdate','tblcontract.amount as c_amount','tblserviceinvoiceheader.*','tblserviceinvoiceheader.date as s_date','tblserviceinvoicedetail.*','tblserviceinvoicedetail.amount as s_amount','tblprogressdetail.*','tblprogressbill.Mode')
        ->first();
        // dd($print_prog_bill);
        $utilities = CompanyUtil::all();
                

               
            if($print->count()!=0)
            {
                    foreach ($print as $key ) {
                     $key->s_amount=number_format($key->s_amount,2);
                     $key->subtotal=number_format($key->subtotal,2);
                     $key->taxValue=number_format($key->taxValue,2);      
                    }  
                    $pdf = PDF::loadView('layouts.BD.transact.billing.print',compact('print','utilities','id'))->setPaper('letter','portrait'); 
            }
            else
            {
                 $print_prog_bill->c_amount=number_format($print_prog_bill->c_amount,2);
                 $print_prog_bill->subtotal=number_format($print_prog_bill->subtotal,2);
                 $print_prog_bill->taxValue=number_format($print_prog_bill->taxValue,2);
                 $print_prog_bill->retValue=number_format($print_prog_bill->retValue,2);
                 $print_prog_bill->recValue=number_format($print_prog_bill->recValue,2);
                 $print_prog_bill->initial=number_format($print_prog_bill->initial,2);     
                 $print_prog_bill->s_amount=number_format($print_prog_bill->s_amount,2);

                 $pdf = PDF::loadView('layouts.BD.transact.billing.print_pb',compact('print_prog_bill','utilities','id'))->setPaper('letter','portrait'); 
            }
                     
                
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


    public function show($id)
    {
        //
       
        // dd($updallwt);
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
         $prog = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->join('tblprogressdetail','tblprogressdetail.PB_ID','tblprogressbill.id')
        ->where('tblcontract.id',$id)
        ->where('tblprogressbill.status',0)
        ->orderby('tblprogressbill.Mode','ASC')
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.*','tblprogressbill.amount as pb_amount','tblprogressdetail.*','tblprogressbill.Mode')
        ->first();
        // dd($prog);
             if(count($prog)!=null)
             {
                $prog->pb_amount=number_format($prog->pb_amount,2);
             $prog->amount=number_format($prog->amount,2);
             $prog->initialtax=number_format($prog->initialtax,2);
             $prog->taxValue=number_format($prog->taxValue,2);
             $prog->retValue=number_format($prog->retValue,2);
             $prog->recValue=number_format($prog->recValue,2);
             $prog->initial=number_format($prog->initial,2);
             }
                

        $prog1= ProgressBill::join('tblprogressdetail','tblprogressdetail.PB_ID','tblprogressbill.id')
        ->select('tblprogressbill.amount','tblprogressdetail.initialtax')
        ->where('ContractID',$id)
        ->orderBy('Mode','ASC')
        ->first();
        
        $down1 = Downpayment::select('tbldownpayment.*')
        ->where('ContractID',$id)
        ->first();  
        
        $getpaidpb = Contract::join('tblprogressbill','tblprogressbill.ContractID','tblcontract.id')
        ->select('tblprogressbill.Mode')
        ->where('tblprogressbill.status',1)
        ->get();
        $date = Carbon::now();
        $utilities = CompanyUtil::all();
        $invoiceid = $this->getID();

        $com = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->where('tblcontracttask.active','!=',2)
        ->sum('tblduedetail.progress');

         $count_incur = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->where('tblincurrences.status',0)
        // ->groupby('tblcontracttask.id')
        ->count('tblincurrences.id');

        $tasktable = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        ->select('tblservtask.ServTask','tblservtask.total as s_total','tblservtask.id as serv_id','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.progress','tblcontracttask.wt','tblcontracttask.id as task_id','tblduedetail.percent','tblcontracttask.status as ct_status','tblincurrences.method')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->orderby('tblcontracttask.id','ASC')
        ->get();
        // dd($tasktable);
        // $paid_incur = DB::table('tblcontract')
        // ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        // ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        // ->where('tblcontract.id',$id)
        // ->groupby('tblcontracttask.id','tblservtask.total')
        // ->where('tblincurrences.status',1)
        // ->select(DB::raw('(SUM(tblincurrences.amount) + tblservtask.total) as paidamount'),'tblcontracttask.id as pt_id')
        // ->get();

        $incur = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->leftjoin('tblincurrences','tblincurrences.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        // ->where('tblincurrences.status',0)
        ->groupby('tblcontracttask.id','tblservtask.total','tblincurrences.status')
        ->select(DB::raw('SUM(tblincurrences.amount) as incur_amount'),DB::raw('(SUM(tblincurrences.amount) + tblservtask.total) as paidamount'),'tblcontracttask.id as t_id','tblincurrences.status')
        ->get();
        
        

        // dd($count_incur);

        foreach ($tasktable as $key ) {
             $key->s_total=number_format($key->s_total,2);

             // $key->progress = ($key->progress/$key->wt)*100;
            }
        foreach ($incur as $hehe ) {
             $hehe->incur_amount=number_format($hehe->incur_amount,2);

             // $key->progress = ($key->progress/$key->wt)*100;
            }

        return view('layouts.BD.transact.billing.index', compact('contract','down','date','utilities','invoiceid','down1','id','com','prog','prog1','getpaidpb','count_incur','tasktable','incur'));
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
