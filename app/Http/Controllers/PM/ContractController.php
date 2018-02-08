<?php

namespace App\Http\Controllers\PM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\ContractTask;
use App\DueDetail;
use App\DueWT;
use Carbon\carbon;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->leftjoin('tblduewt','tblduewt.TaskID','tblcontracttask.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->select('tblservtask.ServTask','tblservtask.duration','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.date as p_date','tblduedetail.progress as p_prog','tblduewt.wt')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->get();
        

        $o_contname = Contract::where('tblcontract.id',$id)->first();

        $o_contfrom =DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->select('tblcontracttask.from')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblcontracttask.from = (SELECT MIN(tblcontracttask.from) FROM tblcontracttask WHERE tblcontracttask.ContractID = tblcontract.id)')
        ->first();

        $o_contto =DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->select('tblcontracttask.to')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblcontracttask.to = (SELECT MAX(tblcontracttask.to) FROM tblcontracttask WHERE tblcontracttask.ContractID = tblcontract.id)')
        ->first();

        $min=Carbon::parse($o_contfrom->from);
        $max=Carbon::parse($o_contto->to);
        $ov_dur= $min->diffInDays($max);

        $o_wt = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduewt','tblduewt.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->sum('tblduewt.wt');

        $o_com = Contract::join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->leftjoin('tblduedetail','tblduedetail.TaskID','tblcontracttask.id')
        ->where('tblcontract.id',$id)
        ->whereRaw('tblduedetail.date = (SELECT MAX(tblduedetail.date) FROM tblduedetail WHERE tblduedetail.TaskID = tblcontracttask.id)')
        ->sum('tblduedetail.progress');

        return view('layouts.PM.transact.contract.contract',compact('task','id','o_contname','o_contto','o_contfrom','ov_dur','o_wt','o_com'));
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
        $wt = DueWT::where('TaskID',$request->taskID)
        ->select('tblduewt.wt')
        ->first();

        $checkstat = ContractTask::where('id',$request->taskID)
        ->select('tblcontracttask.to_addDay','tblcontracttask.to','tblcontracttask.from')
        ->first();
        $now = Carbon::now();

        if($request->progress == 100)
        {
            if($now < $checkstat->to_addDay)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 2;
                $task->save();
            }
            elseif($now == $checkstat->to && $now<$checkstat->to_addDay)
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 1;
                $task->save();
            }
            else
            {
                $task = ContractTask::find($request->taskID);
                $task->status = 3;
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

        $compute = ($request->progress/100)*($wt->wt); 

        $updtask = new DueDetail();
        $updtask->TaskID = $request->taskID;
        $updtask->progress = $compute;
        $updtask->date = Carbon::now();
        $updtask->save();

        return Response($updtask);

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
