<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;
use App\Http\Controllers\Controller;

use App\Retention;
use Response;
use Illuminate\Http\Request;

class RetentionUtilController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        $retention = Retention::where('todelete','=',1)->get();
        return view('layouts.O.utilities.retention.retention',compact('retention'));
    }
    
    public function store(Request $request)
    {
        //
         $retstore = Retention::where('RetValue', $request->value )
            ->where('todelete','=',1)
            ->get();
        if($retstore->count() == 0)
        {
            Retention::insert([
            	'RetValue'=>$request->value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($retstore);
        }
    }
    public function edit($id)
    {
        //
        $pfedit = Retention::find($id);
        return Response($pfedit);
    }

   public function update(Request $request, $id)
    {
        //
        $updclass = Retention::find($id);
            $updclass->RetValue = $request->RetValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = Retention::find($id);
        if ($matclass->status) {
            $matclass->status=0;
        }
        else{
            $matclass->status=1;
        }
        $matclass->save();
    }

    public function delete($id)
    {
        $matclass = Retention::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
}
