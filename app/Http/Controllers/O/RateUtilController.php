<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Rate;
use DB;
use Response;
class RateUtilController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        $rate = Rate::where('todelete','=',1)->get();
        return view('layouts.O.utilities.rate.rate',compact('rate'));
    }

    public function store(Request $request)
    {
        $addrate = Rate::where('RateDesc', '=', $request->desc )
            ->where('todelete','=',1)
            ->get();
        if($addrate->count() == 0)
        {
            Rate::insert(['RateDesc'=>$request->desc,
                'RateValue'=>$request->value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($addrate);
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
        $rateEdit = Rate::find($id);
        return Response($rateEdit);
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
        $updclass = Rate::find($id);
            $updclass->RateDesc = $request->RateDesc;
            $updclass->RateValue = $request->RateValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = Rate::find($id);
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
        $matclass = Rate::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
    public function destroy($id)
    {
        //
    }
}
