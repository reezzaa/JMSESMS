<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Specialization;
use App\SpecRate;
use Response;
use DB;
use Carbon\carbon;
class SpecializationController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:operations');
    }

     public function index()
    {
        $specCheck = Specialization::where('status','=',1)->where('todelete','=',1)->get();
        
        return view('layouts.O.mainte.specialization.index', compact('specCheck'));
    }

    public function readByAjax()
    {
         $spec = DB::table('tblspecialization')
        // ->join('tblspecrate','tblspecrate.SpecID','tblspecialization.id')
        ->select('tblspecialization.*')
        ->where('todelete','=',1)
        // ->whereRaw('tblspecrate.date=(SELECT MAX(tblspecrate.date)from tblspecrate where tblspecrate.SpecID=tblspecialization.id)')
        ->get();
        foreach ($spec as $key ) {
             $key->rpd=number_format($key->rpd,2);
                
            }

        return view('layouts.O.mainte.specialization.table', compact('spec'));
    }

    public function store(Request $request)
    {
         $specdescAdd = Specialization::where('SpecDesc', $request->SpecDesc )
            ->where('todelete','=',1)
            ->get();
         // $specdesc = Specialization::where('SpecDesc', $request->SpecDesc )
         //    ->where('date', $request->specdate )
         //    ->where('todelete','=',1)
         //    ->get();
        if($specdescAdd->count() == 0)
        {
        
            $spec = new Specialization();
            $spec->SpecDesc = $request->SpecDesc;
            $spec->rpd = $request->rpd;
            $spec->date = $request->specdate;
            $spec->todelete = 1;
            $spec->status = 1;
            $spec->save();

            $updclass = new SpecRate();
            $updclass->SpecID = $spec->id;
            $updclass->date = $request->specdate;
            $updclass->up_rpd = $request->rpd;
            $updclass->save();

            return Response($spec);
        }
        // elseif ( $specdesc->count() == 0)
        //  {
            
        // }
    }

    public function edit($specID)
    {
        $spece = Specialization::leftjoin('tblspecdate','tblspecdate.SpecID','tblspecialization.id')
        ->select('tblspecialization.SpecDesc','tblspecialization.id','tblspecialization.rpd','tblspecialization.date')
        ->where('tblspecialization.id',$specID)
        ->orderby('tblspecdate.date','DESC')
        ->first();

        return Response($spece);
    }
    public function show($id)
    {
        $spece = Specialization::leftjoin('tblspecdate','tblspecdate.SpecID','tblspecialization.id')
        ->select('tblspecialization.SpecDesc','tblspecialization.id','tblspecdate.up_rpd','tblspecdate.date')
        ->where('tblspecialization.id',$id)
        ->orderby('tblspecdate.date','DESC')
        ->get();
        // dd($spece);
        return Response($spece);
    }

    public function update(Request $request, $specID)
    {
         $specdescAdd = Specialization::where('rpd', $request->rpd )
            ->where('date', $request->specdate )
            ->where('todelete','=',1)
            ->get();
         if($specdescAdd->count() == 0)
        {
            $updclass = Specialization::find($specID);
            $updclass->SpecDesc = $request->SpecDesc;
            $updclass->rpd = $request->rpd;
            $updclass->date = $request->specdate;
            $updclass->save();

            $updskill = new SpecRate();
            $updskill->SpecID=$specID;
            $updskill->date = $request->specdate;
            $updskill->up_rpd = $request->rpd;
            $updskill->save();
        }
        else
        {
            $updclass = Specialization::find($specID);
            $updclass->SpecDesc = $request->SpecDesc;
            $updclass->save();

        }
       
           
            return Response($updclass);
      
    }
    
    public function checkbox($id)
    {
        $equiptype = Specialization::find($id);
        if ($equiptype->status) {
            $equiptype->status=0;
        }
        else{
            $equiptype->status=1;
        }
        $equiptype->save();
    }

    public function delete($specID)
    {
        $equiptype = Specialization::find($specID);
        $equiptype->todelete = 0;
        $equiptype->save();
        return Response($equiptype);
    }

}
