<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\GroupUOM;
use App\DetailUOM;
use Response;

class DetailUOMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth:operations');
    }

    public function index()
    {
        return view('layouts.O.mainte.uom.detailindex', ['groupuom'=> GroupUOM::where('status','=',1)->where('todelete','=',1)->pluck('GroupUOMText', 'id')]);
    }

    public function readByAjax()
    {
        $detailuom = DetailUOM::join('tblGroupUOM', 'tblDetailUOM.GroupUOMID', '=', 'tblGroupUOM.id')
            ->select('tblDetailUOM.*','tblGroupUOM.GroupUOMText')
            ->orderby('tblDetailUOM.id')
            ->where('tblDetailUOM.todelete','=',1)
            ->where('tblGroupUOM.todelete','=',1)
            ->where('tblGroupUOM.status','=',1)
            ->get();
        return view('layouts.O.mainte.uom.detailtable', ['detailuom'=>$detailuom, 'groupuom'=> GroupUOM::where('status','=',1)->where('todelete','=',1)->pluck('GroupUOMText', 'id')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detailAdd = DetailUOM::where('DetailUOMText', '=', $request->DetailUOMText )
            ->where('todelete','=',1)
            ->get();
        $symbolAdd = DetailUOM::where('UOMUnitSymbol', '=', $request->UOMUnitSymbol )
            ->where('todelete','=',1)
            ->get();
        if($detailAdd->count() != 0)
        {
        }
        if($symbolAdd->count() != 0)
        {
        }
        if($detailAdd->count() == 0 && $symbolAdd->count() == 0)
        {
            $res = DetailUOM::insertGetId(['GroupUOMID'=>$request->GroupUOMID,
                'UOMUnitSymbol'=>$request->UOMUnitSymbol,
                'DetailUOMText'=>$request->DetailUOMText,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($res);
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
        $detailuome = DetailUOM::find($id);
        return Response($detailuome);
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

            $updequip = DetailUOM::find($id);
            $updequip->DetailUOMText = $request->DetailUOMText;
            $updequip->GroupUOMID = $request->GroupUOMID;
            $updequip->UOMUnitSymbol = $request->UOMUnitSymbol;
            $updequip->save();
            return Response($updequip);
    }

    public function checkbox($id)
    {
        $equip = DetailUOM::find($id);
        if ($equip->status) {
            $equip->status=0;
        }
        else{
            $equip->status=1;
        }
        $equip->save();
    }

    public function delete($equipID)
    {
        $equip = DetailUOM::find($equipID);
        $equip->todelete = 0;
        $equip->save();
        return Response($equip);
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


