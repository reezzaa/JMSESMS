<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;
use App\Http\Controllers\Controller;

use App\Fee;
use DB;
use Response;
use Illuminate\Http\Request;

class FeeUtilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        $fee = Fee::where('todelete','=',1)->get();
        return view('layouts.O.utilities.fee.fee',compact('fee'));
    }
    
    public function store(Request $request)
    {
        //
         $addfee = Fee::where('FeeDesc', $request->desc )
            ->where('todelete','=',1)
            ->get();
        if($addfee->count() == 0)
        {
            Fee::insert(['FeeDesc'=>$request->desc,
                'FeeValue'=>$request->value,
                'todelete'=>1,
                'status'=>1,
                ]);
            return Response($addfee);
        }
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
        $feeEdit = Fee::find($id);
        return Response($feeEdit);
    }

   public function update(Request $request, $id)
    {
        //
        $updclass = Fee::find($id);
            $updclass->FeeDesc = $request->FeeDesc;
            $updclass->FeeValue = $request->FeeValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = Fee::find($id);
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
        $matclass = Fee::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
    public function destroy($id)
    {
        //
    }
}
