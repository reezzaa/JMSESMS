<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\GroupUOM;
use Response;

class GroupUOMController extends Controller
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
        $groupUOMcheck = GroupUOM::where('status','=',1)->where('todelete','=',1)->get();
        
        return view('layouts.O.mainte.uom.groupindex', compact('groupUOMcheck'));
    }

    public function readByAjax()
    {
         $groupuom = GroupUOM::where('todelete','=',1)->get();

        return view('layouts.O.mainte.uom.grouptable', compact('groupuom'));
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
        $groupuomAdd = GroupUOM::where('GroupUOMText', '=', $request->GroupUOMText )
            ->where('todelete','=',1)
            ->get();
        if($groupuomAdd->count() == 0)
        {
            GroupUOM::insert(['GroupUOMText'=>$request->GroupUOMText,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($groupuomAdd);
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
        $groupuomee = GroupUOM::find($id);
        return Response($groupuomee);
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
        $groupuomdesc = GroupUOM::where('GroupUOMText', '=', $request->GroupUOMText )
                ->where('todelete','=',1)
                ->get();
        if($groupuomdesc->count() == 0)
        {
            $updclass = GroupUOM::find($id);
            $updclass->GroupUOMText = $request->GroupUOMText;
            $updclass->save();
            return Response($updclass);
        }
    }

    public function checkbox($id)
    {
        $equiptype = GroupUOM::find($id);
        if ($equiptype->status) {
            $equiptype->status=0;
        }
        else{
            $equiptype->status=1;
        }
        $equiptype->save();
    }

    public function delete($id)
    {
        $equiptype = GroupUOM::find($id);
        $equiptype->todelete = 0;
        $equiptype->save();
        return Response($equiptype);
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
