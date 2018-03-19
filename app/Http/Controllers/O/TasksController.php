<?php

namespace App\Http\Controllers\O;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServicesOffered;
use Response;
use App\Material;
use App\MaterialClass;
use App\DetailUOM;
use App\Equipment;
use App\Specialization;
use App\Fee;
use App\ServMFee;
use App\ServWFee;
use DB;
use App\ServWorker;
use App\ServMaterial;
use App\Stocks;
use App\ServEquipment;
use App\ServTask;
use Carbon\carbon;
class TasksController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        $serveCheck = ServTask::where('status','=',1)->where('todelete','=',1)->get();
        
        return view('layouts.O.mainte.tasks.index', compact('serveCheck'));
    }

    public function readByAjax()
    {
        $serve = ServTask::join('tblservicesoffered','tblservicesoffered.id','tblservtask.ServOffID')
        ->select('tblservtask.*','tblservicesoffered.ServiceOffName')
        ->where('tblservtask.todelete',1)
        ->get();

        // dd($serve);
        foreach ($serve as $key ) {
             $key->total=number_format($key->total,2);
                
            }

        return view('layouts.O.mainte.tasks.table', compact('serve'));
    }

    public function store(Request $request)
    {
        $i='';
        $test='';
        $wtest='';
        $getTotalRPD='';
        $getTotalMat='';
        $getTotalEquip='';
        $initialRPD='';
        $initialFee='';
        $getWorkFee='';
        $getMatFee='';
        $totalFee='';
        
        $servOff = new ServTask();
        $servOff->ServOffID = $request->service;
        $servOff->ServTask = $request->taskname;
        $servOff->duration = $request->duration;
        $servOff->remarks = $request->servdesc;
        $servOff->status = 1;
        $servOff->total = 0;
        $servOff->todelete = 1;
        $servOff->save();

        for($i = 0;$i<count($request->worker);$i++)
        {
            $wtest = new ServWorker();
            $wtest->ServID = $servOff->id;
            $wtest->SpecID = $request->worker[$i];
            $wtest->quantity = $request->workerqty[$i];
            $wtest->todelete = 1;
            $wtest->save();

            $initialRPD = $request->workerqty[$i]*$request->rpd[$i]*$servOff->duration*8;

            $initialFee = ($initialRPD * $request->workfeeval)/100;

            if($initialFee!=null)
            {

            $fee = new ServWFee();
            $fee->ServWID = $wtest->id;
            $fee->FeeID = $request->addworkfee;
            $fee->amount = $initialFee;
            $fee->save();
            $getWorkFee += $initialFee;

            }
            $getTotalRPD += $initialRPD;

        }
        for($i = 0;$i<count($request->material);$i++)
        {
            $getTotalMat+= $request->cost[$i];

            $test = new ServMaterial();
            $test->ServID = $servOff->id;
            $test->MatID = $request->material[$i];
            $test->quantity = $request->materialqty[$i];
            $test->todelete = 1;
            $test->total = $request->cost[$i];
            $test->save();

            $sto = new Stocks();
            $sto->ServMatID = $test->id;
            $sto->stocks = $test->quantity;
            $sto->save();


        }
        for($i = 0;$i<count($request->equipname);$i++)
        {
            $test = new ServEquipment();
            $test->ServID = $servOff->id;
            $test->EquipID = $request->equipname[$i];
            $test->todelete = 1;
            $test->save();

            $getTotalEquip += $request->equiprice[$i];

        }
        
        if($request->matfeeval!=null)
        {
        $getMatFee = ($getTotalMat * $request->matfeeval)/100;

        $fee = new ServMFee();
        $fee->ServID = $servOff->id;
        $fee->FeeID = $request->addmatfee;
        $fee->amount = $getMatFee;
        $fee->save();
        }
    
        $totalFee =  $getWorkFee + $getMatFee;

        $total = ServTask::find($servOff->id);
        $total->total= $getTotalRPD + $getTotalMat + $getTotalEquip + $totalFee;
        $total->save();
       
        // dd($total);
        // return redirect()->route('serviceOff.index');
        return Response($servOff);

    }

    public function create()
    {
        $spec = Specialization::where('status',1)->where('todelete',1)->get();

        $serv = ServicesOffered::where('status',1)->where('todelete',1)->get();

        
        $material = Material::join('tblMaterialClass','tblMaterial.MatClassID','tblMaterialClass.id')
                    ->select('tblMaterial.*','tblMaterialClass.*')
                    ->where('tblMaterial.status',1)
                    ->where('tblMaterial.todelete',1)
                    ->where('tblMaterialClass.todelete',1)
                    ->where('tblMaterialClass.status',1)
                    ->get();

        $materialClass = MaterialClass::where('status',1)
                        ->where('todelete',1)
                        ->get();
        $uom = DetailUOM::where('status',1)
                        ->where('todelete',1)
                        ->get();
         $equip = Equipment::where('tblEquipment.status',1)
        ->where('tblEquipment.todelete',1)
        ->get();

        $addfee = Fee::where('status',1)
                        ->where('todelete',1)
                        ->get();
        return view('layouts.O.mainte.tasks.addtask', compact('spec','material','materialClass','uom','equip','addfee','serv'));
    }
     public function readMaterial()
    {
        
        return view('layouts.O.mainte.tasks.resourcetable.tablemat');
    }

    public function readEquipment()
    {
        
        
        return view('layouts.O.mainte.tasks.resourcetable.tableequip');
    }

    public function readWorker()
    {
        
        return view('layouts.O.mainte.tasks.resourcetable.tableworker');
    }
    public function getMatPrice($id)
    {
        $matprice = Material::where('id',$id)->get();
        
        return Response($matprice);
    }
    public function getEPrice($id)
    {
        $equiprice = Equipment::where('id',$id)->get();
        
        return Response($equiprice);
    }
    public function findRPD($id)
    {
        $rpd = Specialization::where('id',$id)
                    ->where('status',1)
                    ->where('todelete',1)
                    ->get();
        return Response($rpd);
    }

    public function findMatbyClass($id)
    {
        $matbyClass = Material::where('MatClassID',$id)
                    ->where('status',1)
                    ->where('todelete',1)
                    ->get();
        return Response($matbyClass);
    }

    public function findMatbyUOM($id)
    {
        $matbyClass = Material::where('MatUOM',$id)
                    ->where('status',1)
                    ->where('todelete',1)
                    ->get();
        return Response($matbyClass);
    }

    public function findMatbyNone()
    {
        $none = Material::where('status',1)
                        ->where('todelete',1)
                        ->get();

        return Response($none);
    }

    
    public function findFee($id)
    {
        $fee = Fee::where('id',$id)
                        ->where('status',1)
                        ->where('todelete',1)
                        ->get();

        return Response($fee);
    }
    public function edit($serveID)
    {
        $servee = ServTask::find($serveID);
        return Response($servee);
    }
    public function show($id)
    {
        $serv = ServTask::where('id',$id)
        ->where('status',1)
        ->where('todelete',1)
        ->get();
       return Response($serv);
    }
    public function update(Request $request, $serveID)
    {
        // $servename = ServicesOffered::where('ServiceOffName', '=', $request->ServiceOffName )
        //         ->where('todelete','=',1)
        //         ->get();
        // if($servename->count() == 0)
        // {
        //     $updserve = ServicesOffered::find($serveID);
        //     $updserve->ServiceOffName = $request->ServiceOffName;
        //     $updserve->save();
        //     return Response($updserve);
        // } 
    }
    
    public function checkbox($id)
    {
        $serve = ServicesOffered::find($id);
        if ($serve->status) {
            $serve->status=0;
        }
        else{
            $serve->status=1;
        }
        $serve->save();
    }

    public function delete($serveID)
    {
        $serve = ServicesOffered::find($serveID);
        $serve->todelete = 0;
        $serve->save();
        return Response($serve);
    }
    public function getSpec($id)
    {
        $ser = Specialization::where('id',$id)
        ->first();
        return Response($ser);
    }
    public function getMat($id)
    {
        $mat = Material::where('id',$id)
        ->first();
        return Response($mat);
    }
    public function getEqui($id)
    {
        $eq = Equipment::where('id',$id)
        ->first();
        return Response($eq);
    }
}
