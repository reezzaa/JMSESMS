<?php

namespace App\Http\Controllers\O;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Miscellaneous;
use App\Response;

class ExpensesController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        //
        $bankcheck = Miscellaneous::where('status','=',1)->where('todelete','=',1)
            ->get();
        return view('layouts.O.mainte.expenses.index', compact('bankcheck'));
    }

    public function readByAjax()
    {
        $misc = Miscellaneous::where('todelete','=',1)
        ->get();
        foreach ($misc as $key ) {
             $key->MiscValue=number_format($key->MiscValue,2);
                
            }
        // dd($misc);
        return view('layouts.O.mainte.expenses.table', compact('misc'));
    }
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
        //
        $bankAdd = Miscellaneous::where('MiscDesc', '=', $request->Desc )
            ->where('todelete','=',1)
            ->get();
        if($bankAdd->count() == 0)
        {
            Miscellaneous::insert(['MiscDesc'=>$request->Desc,
                'MiscValue'=>$request->Value,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($bankAdd);
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
         $bankSearch = Miscellaneous::find($id);
        return Response($bankSearch);
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
            $updclass->MiscDesc= $request->Desc;
            $updclass->MiscValue= $request->Value;
            $updclass->save();
            return Response($updclass);
    }

    public function checkbox($id)
    {
        $bankstat = Miscellaneous::find($id);
        if ($bankstat->status) {
            $bankstat->status=0;
        }
        else{
            $bankstat->status=1;
        }
        $bankstat->save();
    }

    public function delete($id)
    {
        $bankDel = Miscellaneous::find($id);
        $bankDel->todelete = 0;
        $bankDel->save();
        return Response($bankDel);
    }
}
