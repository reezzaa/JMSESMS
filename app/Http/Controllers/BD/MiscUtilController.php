<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\BD;
use App\Http\Controllers\Controller;

use App\Miscellaneous;
use DB;
use Response;
use Illuminate\Http\Request;

class MiscUtilController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        $misc = Miscellaneous::where('todelete',1)->get();
        return view('layouts.BD.utilities.miscellaneous.miscellaneous',compact('misc'));
    }

    public function store(Request $request)
    {
        //
         $addmisc = Miscellaneous::where('MiscDesc', $request->desc )
            ->where('todelete','=',1)
            ->get();
        if($addmisc->count() == 0)
        {
            Miscellaneous::insert(['MiscDesc'=>$request->desc,
                'MiscValue'=>$request->value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($addmisc);
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
         $miscEdit = Miscellaneous::find($id);
        return Response($miscEdit);
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
        $updclass = Miscellaneous::find($id);
            $updclass->MiscDesc = $request->MiscDesc;
            $updclass->MiscValue = $request->MiscValue;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $matclass = Miscellaneous::find($id);
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
        $matclass = Miscellaneous::find($id);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
    public function destroy($id)
    {
        //
    }
}
