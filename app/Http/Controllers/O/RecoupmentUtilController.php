<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;
use App\Http\Controllers\Controller;

use App\Recoupment;
use Response;
use Illuminate\Http\Request;

class RecoupmentUtilController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        $recoupment = Recoupment::where('todelete','=',1)->get();
        return view('layouts.O.utilities.recoupment.recoupment',compact('recoupment'));
    }
    
    public function store(Request $request)
    {
        //
         $recstore = Recoupment::where('RecValue', $request->value )
            ->where('todelete','=',1)
            ->get();
        if($recstore->count() == 0)
        {
            Recoupment::insert([
            	'RecValue'=>$request->value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($recstore);
        }
    }
    public function edit($id)
    {
        //
        $pfedit = Recoupment::find($id);
        return Response($pfedit);
    }

   public function update(Request $request, $id)
    {
        //
        $updclass = Recoupment::find($id);
            $updclass->RecValue = $request->RecValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = Recoupment::find($id);
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
        $matclass = Recoupment::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
}
