<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\BD;
use App\Http\Controllers\Controller;

use App\PaymentMode;
use Response;
use Illuminate\Http\Request;

class PaymentModeUtilController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $mode = PaymentMode::where('todelete','=',1)->get();
        return view('layouts.BD.utilities.paymentmode.paymentmode',compact('mode'));
    }
    
    public function store(Request $request)
    {
        //
         $modestore = PaymentMode::where('ModeValue', $request->value )
            ->where('todelete','=',1)
            ->get();
        if($modestore->count() == 0)
        {
            PaymentMode::insert([
            	'ModeValue'=>$request->value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($modestore);
        }
    }
    public function edit($id)
    {
        //
        $pfedit = PaymentMode::find($id);
        return Response($pfedit);
    }

   public function update(Request $request, $id)
    {
        //
        $updclass = PaymentMode::find($id);
            $updclass->ModeValue = $request->ModeValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = PaymentMode::find($id);
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
        $matclass = PaymentMode::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
}
