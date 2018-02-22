<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\ServTask;
use App\ServicesOffered;
use App\PaymentMode;
use App\Tax;
use App\Contract;
use App\ContractOrder;
use App\ContractTask;
use App\ProgressBill;
use App\ProgressBillDetail;
use App\Downpayment;
use App\DueDetail;
use App\Miscellaneous;
use App\Rate;
use App\ContractMisc;
use App\ContractRate;
use DateTime;
use Carbon\carbon;
use DB;
use Response;
class SetupContractController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:projectmanager');

    }
    public function index()
    {
        //
        $client = Client::where('status',1)
        ->where('todelete',1)
        ->orderby('strCompClientID')
        ->get();

        $task = ServTask::join('tblservicesoffered','tblservicesoffered.id','tblservtask.ServOffID')
        ->where('tblservicesoffered.todelete',1)
        ->where('tblservicesoffered.status',1)
        ->where('tblservtask.todelete',1)
        ->where('tblservtask.status',1)
        ->select('tblservtask.*','tblservicesoffered.id as servid')
        ->get();

        $service = ServicesOffered::where('status',1)
        ->where('todelete',1)
        ->get();

        $mode = PaymentMode::where('todelete',1)
        ->where('status',1)
        ->orderby('ModeValue','ASC')
        ->get();

        $tax = Tax::where('todelete',1)
        ->where('status',1)
        ->orderby('TaxValue','ASC')
        ->get();
        $rate = Rate::where('todelete',1)
        ->where('status',1)
        ->orderby('id','ASC')
        ->get();
        $misc = Miscellaneous::where('todelete',1)
        ->where('status',1)
        ->orderby('id','ASC')
        ->get();
        return view('layouts.PM.transact.setup.index',compact('client','task','service','mode','tax','rate','misc'));
    }

    public function getContractPattern()
    {
        $id = DB::table('tblContractIDUtil')->get();
        foreach($id as $id)
        {
            return $id->strContractIDUtil;
            // dd($id);
        }
    }

    public function getLastPattern()
    {
        $id = DB::table('tblContract')
        ->select('tblContract.id')
        ->orderBy('tblContract.id','desc')
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
        $scanEmp = Contract::all();
        if($scanEmp->count() == 0)
        {
            $splitID = $this->Splits($this->getContractPattern());
            $incrementedID = $this->Incremented($splitID);
            $contractID = $incrementedID;
            return $contractID;
        }
        else
        {
            $splitID = $this->Splits($this->getLastPattern());
            $incrementedID = $this->Incremented($splitID);
            $contractID = $incrementedID;
            return $contractID;
        }

    }
    public function store(Request $request)
    {
        $contractID = $this->getID(); 
         $u='';
         $ov_dur='';
         for ($u=0; $u < count($request->task) ; $u++) { 
            $ov_dur+= $request->duration[$u];

         }

           Contract::insert([
                'id'=>$contractID,
                'ClientID'=>$request->client,
                'TaxID'=>$request->vat,
                'name'=>$request->contractname,
                'datesigned'=>$request->datesigned,
                'from'=>$request->from,
                'to'=>$request->to,
                'location'=>$request->location,
                'term'=>$request->term,
                'termdate'=>$request->termdate,
                'amount'=>$request->newcost,
                'status'=>0,
                'active'=>0,
                'over_dur'=>$ov_dur
                ]);
           
           $co = new ContractOrder();
           $co->ContractID = $contractID;
           $co->co = $request->co;
           $co->date = $request->co_date;
           $co->save();

           $i='';

           for ($i=0; $i < count($request->miscdesc) ; $i++) 
           { 
            $misc = new ContractMisc();
            $misc->ContractID = $contractID;
            $misc->MiscID = $request->miscdesc[$i];
            $misc->save();
           }

           for ($i=0; $i < count($request->ratedesc) ; $i++) 
           {
            $rate = new ContractRate();
            $rate->ContractID = $contractID;
            $rate->RateID = $request->ratedesc[$i];
            $rate->save(); 
           }

           
           // $datetime = new DateTime($min);
           // $datetime2 = new DateTime($max);
           // $interval = $datetime2->diff($datetime);
           // $days = $interval->format('%a');


           
                for ($i=0; $i < count($request->task) ; $i++) { 
                    
                    
                    $from = Carbon::parse($request->task_from[$i]);
                    $task = new ContractTask();
                    $task->ContractID = $contractID;
                    $task->ServID = $request->task[$i];
                    $task->from = $request->task_from[$i];
                    $task->to = $from->addDays($request->duration[$i]);
                    $task->to_addDay = Carbon::parse($task->to)->addDay();
                    $task->status = 0;
                    $task->active = 1;
                    $task->wt = ($request->duration[$i]/$ov_dur)*100;
                    $task->save();

                    $updtask = new DueDetail();
                    $updtask->TaskID = $task->id;
                    $updtask->progress = 0;
                    $updtask->date = Carbon::now();
                    $updtask->percent = 0;
                    $updtask->save();
                    
                }           
                $down = new Downpayment();
                $down->ContractID = $contractID;
                $down->amount = $request->newcost * 30/100;
                $down->status = 0;
                $down->taxvalue = $down->amount * $request->vatrate/100;
                $down->initialtax =$down->amount - $down->taxvalue;
                $down->save();

                   $lastvalue=0;
                   $initial = ""; //compute 
                   $comret =""; //retention
                   $comrec = "";//recoupment from downpayment
                   $final=""; //initial less retention and recoupment
                   $getlastvalue=0;
                   $initPB=''; //initial vatable amount
                   $taxPB='';  //tax amount
                for ($i=0; $i < count($request->progress) ; $i++) { 
                    $mode = new ProgressBill();
                    $mode->ContractID = $contractID;
                    $mode->Mode= $request->progress[$i];
                    $mode->status = 0;
                   

                    $getlastvalue=($request->progress[$i]-$lastvalue);
                    $initial=($request->newcost*$getlastvalue)/100;

                    $comrec=($down->amount*$getlastvalue)/100;
                    $comret=($initial*10)/100;

                    $final= $initial-($comret+$comrec);

                    $taxPB = ($final * $request->vatrate)/100;
                    $initPB = $final-$taxPB;
                    $lastvalue=$request->progress[$i];

                    $mode->amount = $final;
                    $mode->RecID = 1;
                    $mode->RetID = 1;
                    $mode->save();

                    $mode_detail = new ProgressBillDetail();
                    $mode_detail->PB_ID = $mode->id;
                    $mode_detail->recValue = $comrec;
                    $mode_detail->retValue = $comret;
                    $mode_detail->initial = $initial;
                    $mode_detail->initialtax = $initPB;
                    $mode_detail->taxValue = $taxPB;
                    $mode_detail->save();
                }

               
                
        \Session::flash('flash_add_success','Contract Added!');
        return redirect('/pm/contract');
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
     public function findTaskbyService($id)
    {
        $matbyClass = ServTask::where('ServOffID',$id)
                    ->where('status',1)
                    ->where('todelete',1)
                    ->get();
        return Response($matbyClass);
    }

    public function findTaskbyNone()
    {
        $none = ServTask::where('status',1)
                        ->where('todelete',1)
                        ->get();

        return Response($none);
    }
    public function getTaskPrice($id)
    {
        $matprice = ServTask::where('id',$id)->get();
        
        return Response($matprice);
    }
    public function getTask($id)
    {
        $ser = ServTask::join('tblservicesoffered','tblservicesoffered.id','tblservtask.ServOffID')
        ->where('tblservtask.id',$id)
        ->select('tblservtask.*','tblservicesoffered.ServiceOffName')
        ->first();
        // dd($ser);
        return Response($ser);
    }
    public function getExpPrice($id)
    {
        $matprice = Miscellaneous::where('id',$id)->get();
        
        return Response($matprice);
    }
    public function getMisc($id)
    {
        $ser = Miscellaneous::where('id',$id)
        ->select('tblmiscellaneous.*')
        ->first();
        // dd($ser);
        return Response($ser);
    }
    public function getRateValue($id)
    {
        $matprice = Rate::where('id',$id)->get();
        
        return Response($matprice);
    }
    public function getRate($id)
    {
        $ser = Rate::where('id',$id)
        ->select('tblrate.*')
        ->first();
        // dd($ser);
        return Response($ser);
    }
}
