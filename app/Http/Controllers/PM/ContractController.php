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
use App\Fee;
use App\Equipment;
use App\Miscellaneous;
use App\Rate;
use App\Material;
use App\TaskWorker;
use App\TaskMaterial;
use App\TaskEquip;
use App\ContractMisc;
use App\ContractRate;
use App\Specialization;
use App\Initial;
use PDF;
use App\FinalProj;
use App\CompanyUtil;
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
        $inc->invoice= null;
        $inc->save();
       
        $findPrice = Contract::find($request->ContractID);
        $findPrice->amount -= $request->total;
        $findPrice->save();
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
        ->select('tblservtask.ServTask','tblservtask.duration','tblcontracttask.from as task_from','tblcontracttask.to as task_to','tblcontracttask.*','tblduedetail.date as p_date','tblduedetail.progress as p_prog','tblduedetail.percent','tblcontracttask.wt','tblcontracttask.active as task_active','tblduedetail.date as d_date')
        ->where('tblcontract.id',$id)
        ->where('tblcontracttask.active','!=',2)
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
        
        $addfee = Fee::where('status',1)
                        ->where('todelete',1)
                        ->get();
        $equip = Equipment::where('tblEquipment.status',1)
        ->where('tblEquipment.todelete',1)
        ->get(); 

        $rate = Rate::where('todelete',1)
        ->where('status',1)
        ->orderby('id','ASC')
        ->get();
        $misc = Miscellaneous::where('todelete',1)
        ->where('status',1)
        ->orderby('id','ASC')
        ->get();
        $check_init = Contract::join('tblinitial','tblinitial.ContractID','tblcontract.id')
        ->where('tblcontract.id',$id)
        ->count('tblcontract.id');

        $check = Contract::where('status',2)
        ->where('id',$id)
        ->count('id');

        
        return view('layouts.PM.transact.contract.contract',compact('cont','o_task','id','o_contname','o_contto','o_contfrom','ov_dur','o_wt','o_com','task','service','ov','addfee','equip','rate','misc','check','check_init'));
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
        $inc->invoice= null;
        $inc->save();

        $findPrice = Contract::find($request->ContractID);
        $findPrice->amount += $request->price;
        $findPrice->save();
 

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

    public function getNewTaskJob($id)
    {
        $newjob = ContractTask::join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservworker','tblservworker.ServID','tblservtask.id')
        ->join('tblspecialization','tblspecialization.id','tblservworker.SpecID')
        ->select('tblspecialization.*','tblspecialization.id as specid')
        ->where('tblcontracttask.id',$id)
        ->get();

        return Response($newjob);
    }
    public function getNewTaskMat($id)
    {
        $newjob = ContractTask::join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->select('tblmaterial.*','tblmaterial.id as matid')
        ->where('tblcontracttask.id',$id)
        ->get();

        return Response($newjob);
    }

    public function getTaskMatPrice($id)
    {
        $mat = Material::where('id',$id)
        ->get();

        return Response($mat);
    }
    public function getTaskEPrice($id)
    {
        $equi = Equipment::where('id',$id)
        ->get();

        return Response($equi);
    }

    public function newJob(Request $request)
    {
       
        $postjob = new TaskWorker();
        $postjob->TaskID = $request->TaskID;
        $postjob->SpecID = $request->SpecID;
        $postjob->FeeID = $request->FeeID;
        $postjob->quantity = $request->quantity;
        $postjob->status = 0;
        $postjob->feeamount = (($request->rpd * $request->quantity)* $request->getfee)/100;
        $postjob->total= ($request->rpd * $request->quantity) + $postjob->feeamount;
        $postjob->save();

        $inc = new Incurrences();
        $inc->TaskID= $request->TaskID;
        $inc->date= Carbon::now();
        $inc->status=0;
        $inc->method='I';
        $inc->desc= $request->name;
        $inc->amount= $postjob->total;
        $inc->invoice= null;
        $inc->save();

        $findPrice = Contract::find($request->ContractID);
        $findPrice->amount += $postjob->total;
        $findPrice->save();
       

        return Response($postjob);

    }
    public function newMat(Request $request)
    {
       
        $postmat = new TaskMaterial();
        $postmat->TaskID = $request->TaskID;
        $postmat->MatID = $request->MatID;
        $postmat->FeeID = $request->FeeID;
        $postmat->quantity = $request->quantity;
        $postmat->status = 0;
        $postmat->feeamount = (($request->price * $request->quantity) * $request->getfee)/100;
        $postmat->total= ($request->price * $request->quantity) + $postmat->feeamount;
        $postmat->save();

        $inc = new Incurrences();
        $inc->TaskID= $request->TaskID;
        $inc->date= Carbon::now();
        $inc->status=0;
        $inc->method='I';
        $inc->desc= $request->name;
        $inc->amount= $postmat->total;
        $inc->invoice=null;
        $inc->save();

        $findPrice = Contract::find($request->ContractID);
        $findPrice->amount += $postmat->total;
        $findPrice->save();

        return Response($postmat);

    }
    public function newEquip(Request $request)
    {
        $postequip = new TaskEquip();
        $postequip->TaskID = $request->TaskID;
        $postequip->EquipID = $request->EquipID;
        $postequip->status = 0;
        $postequip->save();

        $inc = new Incurrences();
        $inc->TaskID= $request->TaskID;
        $inc->date= Carbon::now();
        $inc->status=0;
        $inc->method='I';
        $inc->desc= $request->name;
        $inc->amount= $postequip->total;
        $inc->invoice= null;
        $inc->save();

        $findPrice = Contract::find($request->ContractID);
        $findPrice->amount += $postequip->total;
        $findPrice->save();

        return Response($postequip);

    }

    public function findRPD($id)
    {
        $rpd = Specialization::where('id',$id)
                    ->where('status',1)
                    ->where('todelete',1)
                    ->get();
        return Response($rpd);
    }
    public function newMisc(Request $request)
    {
       
        $postmisc = new ContractRate();
        $postmisc->ContractID = $request->ContractID;
        $postmisc->RateID = $request->RateID;
        $postmisc->status = 0;
        $postmisc->save();
        return Response($postmisc);


    }
    public function newExp(Request $request)
    {
        $postexp = new ContractMisc();
        $postexp->ContractID = $request->ContractID;
        $postexp->MiscID = $request->MiscID;
        $postexp->status = 0;
        $postexp->save();

        return Response($postexp);

    }
    public function findFee($id)
    {
        $fee = Fee::where('id',$id)
        ->select('FeeValue')
        ->get();

        return Response($fee);
    }
    public function turnover(Request $request)
    {
        $init = new Initial();
        $init->ContractID = $request->ContractID;
        $init->officialstartdate = $request->officialstartdate;
        $init->start = $request->start;
        $init->target = $request->target;
        $init->actual = $request->actual;
        $init->save();

        // $updstat = Contract::find($request->ContractID);
        // $updstat->status=2;
        // $updstat->save();

        return Response($init);
    }
    public function closing(Request $request)
    {
        $stat=0;
        if($request->officialenddate < $request->enddate) 
        {
        $stat = 3;
        }
        elseif($request->officialenddate == $request->enddate)
        {
        $stat = 1;

        }
        else
        {
        $stat = 2;

        }

        $fin = new FinalProj();
        $fin->ContractID = $request->ContractID;
        $fin->officialenddate = $request->officialenddate;
        $fin->enddate = $request->enddate;
        $fin->status = $stat;
        $fin->save();


        $updstat = Contract::find($request->ContractID);
        $updstat->status=3;
        $updstat->save();

        return Response($fin);
    }
    public function printTurnoverReport($id)
    {
        $print = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        ->join('tblinitial','tblinitial.ContractID','tblcontract.id')
        ->join('tblfinal','tblfinal.ContractID','tblcontract.id')
        ->select('tblClient.strCompClientRepresentative','tblcontract.name','tblcontract.location','tblinitial.*','tblfinal.*')
        ->where('tblcontract.id',$id)
        ->first();

        $utilities = CompanyUtil::select('strCompanyName')->first();

        $pdf = PDF::loadView('layouts.PM.transact.contract.print',compact('print','utilities','id'))->setPaper('letter','portrait'); 
                $pdfName="myPDF.pdf";
                $location=public_path("docs/$pdfName");
                $pdf->save($location); 
                return $pdf->stream();  
    }
    public function updateHistory($id)
    {
        $update = DueDetail::where('TaskID',$id)
        // ->where('tblduedetail.date','DESC')
        ->get();
        // dd($update);
        foreach ($update as $key ) {
            Carbon::parse($key->date)->toFormattedDateString();
        }

        return Response($update);
    }

}
