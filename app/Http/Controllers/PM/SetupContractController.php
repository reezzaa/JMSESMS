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
use App\ProgressBill;
use App\ContractTask;
use App\Downpayment;
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

        return view('layouts.PM.transact.setup.index',compact('client','task','service','mode','tax'));
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
                'active'=>0
                ]);
           $i='';
                for ($i=0; $i < count($request->task) ; $i++) { 
                    $task = new ContractTask();
                    $task->ContractID = $contractID;
                    $task->ServID = $request->task[$i];
                    $task->status = 0;
                    $task->save();
                }
                for ($i=0; $i < count($request->progress) ; $i++) { 
                    $mode = new ProgressBill();
                    $mode->ContractID = $contractID;
                    $mode->ModeID = $request->progress[$i];
                    $mode->status = 0;
                    $mode->amount = 0;
                    $mode->RecID = 1;
                    $mode->RetID = 1;
                    $mode->save();
                }

                $down = new Downpayment();
                $down->ContractID = $contractID;
                $down->amount = $request->newcost * 30/100;
                $down->status = 0;
                $down->taxvalue = $down->amount * $request->vatrate/100;
                $down->initialtax =$down->amount - $down->taxvalue;
                $down->save();
                
        \Session::flash('flash_add_success','Contract Added!');
        return redirect()->route('receiveorder.index');
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
}
