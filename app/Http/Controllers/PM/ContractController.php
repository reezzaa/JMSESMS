<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\ContractTask;
use App\DueDetail;
use Carbon\carbon;
use App\ServTask;
use App\Incurrences;
use App\ServicesOffered;
use DB;
use Response;
class ContractController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:projectmanager');

    }
    public function index()
    {
        //
        return view('layouts.PM.transact.contract.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readByAjax()
    {
        //
         $cont = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblcontractorder','tblcontractorder.ContractID','tblcontract.id')
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.strCompClientName','tblcontractorder.*')
        ->orderby('tblcontract.id','ASC')
        ->get();

        return view('layouts.PM.transact.contract.table',compact('cont'));
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
        $bankDel = ContractTask::find($request->taskid);
        $bankDel->active = 2;
        $bankDel->wt = $request->zero;
        $bankDel->save();

         $ov_dur= $request->ov_rem - $request->dura;

        $updallwt = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->where('tblcontract.id',$request->ContractID)
        ->where('tblcontracttask.active','!=',2)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->select('tblcontracttask.id as taskid','tblcontracttask.wt','tblservtask.duration','tblduedetail.progress')
        ->get();

        foreach ($updallwt as $key) {
            

            $searchTask = ContractTask::find($key->taskid);
            $searchTask->wt=($key->duration/$ov_dur)*100;
            $searchTask->save();

            $updtask = new DueDetail();
            $updtask->TaskID = $key->taskid;
            $updtask->progress =  ($key->progress/100)*($searchTask->wt);
            $updtask->date = Carbon::now();
            $updtask->percent =($updtask->progress/$searchTask->wt)*100;
            $updtask->save();


            // dd($searchTask);
        }

        $findCont = Contract::find($request->ContractID);
        $findCont->over_dur = $ov_dur;
        $findCont->save();

        $inc = new Incurrences();
        $inc->TaskID= $request->taskid;
        $inc->date= Carbon::now();
        $inc->status=0;
        $inc->method='S';
        $inc->desc= $request->name;
        $inc->amount= $request->total;
        $inc->save();
       
        return Response($bankDel);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $cont = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblcontractorder','tblcontractorder.ContractID','tblcontract.id')
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.strCompClientName','tblcontractorder.co','tblcontractorder.date as co_date')
        ->where('tblcontract.id',$id)
        ->get();

        $o_task = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblstocks','stocks.ServID','tblservtask.id')
        ->select('tblservtask.ServTask','tblservtask.duration','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.date as p_date','tblduedetail.progress as p_prog','tblduedetail.percent','tblcontracttask.wt','tblcontracttask.active as task_active')
        ->where('tblcontract.id',$id)
        ->orderby('tblcontracttask.from','ASC')
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->get();
        
        // dd($task);
        $o_contname = Contract::where('tblcontract.id',$id)->first();

        $o_contfrom =DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->select('tblcontracttask.from')
        ->where('tblcontract.id',$id)
        ->where('tblcontracttask.active',1)
        // ->whereRaw('tblcontracttask.from = (SELECT tblcontracttask.from FROM tblcontracttask WHERE tblcontracttask.ContractID = tblcontract.id GROUP BY(tblcontracttask.from) HAVING MIN(tblcontracttask.from))')
        // ->groupby('tblcontracttask.from')
        ->min('tblcontracttask.from');

        $o_contto =DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->select('tblcontracttask.to')
        ->where('tblcontract.id',$id)
        ->where('tblcontracttask.active','!=',2)
        // ->whereRaw('tblcontracttask.to = (SELECT MAX(tblcontracttask.to) FROM tblcontracttask WHERE tblcontracttask.ContractID = tblcontract.id)')
        // ->first();
        // // ->where('tblcontracttask.active',1)
        // // ->limit(1)
        // // ->get();
        // ->groupby('tblcontracttask.to')
        ->max('tblcontracttask.to');
        
        $min=Carbon::parse($o_contfrom);
        $max=Carbon::parse($o_contto);
        $ov_dur= $min->diffInDays($max);
// dd($o_contfrom);
        $o_wt = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->where('tblcontract.id',$id)
        ->sum('tblcontracttask.wt');

        $o_com = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->where('tblcontracttask.active','!=',2)
        ->sum('tblduedetail.progress');

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

        $ov = Contract::where('id',$id)
        ->select('over_dur')
        ->first();


        return view('layouts.PM.transact.contract.contract',compact('cont','o_task','id','o_contname','o_contto','o_contfrom','ov_dur','o_wt','o_com','task','service','ov'));
    }

      public function storeTask(Request $request)
    {
         

        $ov_dur= $request->ov + $request->duration;

        $updallwt = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->where('tblcontract.id',$request->ContractID)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->where('tblcontracttask.active',1)
        ->select('tblcontracttask.id as taskid','tblcontracttask.wt','tblservtask.duration','tblduedetail.progress')
        ->get();

        foreach ($updallwt as $key) {
            

            $searchTask = ContractTask::find($key->taskid);
            $searchTask->wt=($key->duration/$ov_dur)*100;
            $searchTask->save();

            $updtask = new DueDetail();
            $updtask->TaskID = $key->taskid;
            $updtask->progress =  ($key->progress/100)*($searchTask->wt);
            $updtask->date = Carbon::now();
            $updtask->percent =($updtask->progress/$searchTask->wt)*100;
            $updtask->save();


            // dd($searchTask);
        }
            
        $to_add = Carbon::parse($request->to);
        $from = Carbon::parse($request->from);

        $task = new ContractTask();
        $task->ContractID = $request->ContractID;
        $task->ServID = $request->ServID;
        $task->from = $request->from;
        $task->to = $from->addDays($request->duration);
        $task->to_addDay = $to_add->addDay();
        $task->status = 0;
        $task->active = 0;
        $task->wt = ($request->duration/$ov_dur)*100;
        $task->save();

        $updtask = new DueDetail();
        $updtask->TaskID = $task->id;
        $updtask->progress = 0;
        $updtask->date = Carbon::now();
        $updtask->percent=0;
        $updtask->save();

        $findCont = Contract::find($request->ContractID);
        $findCont->over_dur = $ov_dur;
        $findCont->save();

        $findServ = ServTask::where('id',$request->ServID)
        ->select('tblservtask.ServTask')
        ->first();

        $inc = new Incurrences();
        $inc->TaskID= $task->id;
        $inc->date= Carbon::now();
        $inc->status=0;
        $inc->method='A';
        $inc->desc= $findServ->ServTask;
        $inc->amount= $request->price;
        $inc->save();
 

        return Response($task);
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
    public function edit($id)
    {
        //
        $getID = ContractTask::join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->where('tblcontracttask.id',$id)
        ->select('tblcontracttask.id as con_id','tblservtask.ServTask','tblservtask.total','tblservtask.duration')
        ->first();
        return Response($getID);
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
        $checkstat = ContractTask::where('id',$request->taskID)
        ->select('tblcontracttask.to_addDay','tblcontracttask.to','tblcontracttask.from','tblcontracttask.wt')
        ->first();
        $now = Carbon::now();

        if($request->progress == 100)
        {
            
            if($now > $checkstat->to_addDay)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 3;
                $task->save();
            }
            else
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 1;
                $task->save();
            }
        }
        else
        {
            if($now< $checkstat->from)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 2;
                $task->save();
            }
            elseif($now < $checkstat->to_addDay&& $now <= $checkstat->to&&$now >= $checkstat->from)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 1;
                $task->save();
            }
            elseif($now>= $checkstat->to_addDay)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 3;
                $task->save();
            }
        }

        $compute = ($request->progress/100)*($checkstat->wt); 
        // dd($compute);
        $updtask = new DueDetail();
        $updtask->TaskID = $request->taskID;
        $updtask->progress = $compute;
        $updtask->date = Carbon::now();
        $updtask->percent =($updtask->progress/$checkstat->wt)*100;
        $updtask->save();

        return Response($updtask);

    }

    public function removeTask(Request $request)
    {  
    }
    public function destroy($id)
    {
        //
    }
}
