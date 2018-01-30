<?php

namespace App\Http\Controllers\O;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Response;


class SupplierController extends Controller
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
        //
        return view('layouts.O.mainte.supplier.index');
    }

    public function readByAjax()
    {
        //
        $supp = Supplier::select('tblSupplier.*')
            ->orderby('tblSupplier.id')
            ->where('tblSupplier.todelete','=',1)
            ->get();
        return view('layouts.O.mainte.supplier.table', ['supp'=>$supp]);
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
         $supp = Supplier::where('SuppDesc', '=', $request->SuppDesc )
            ->where('todelete','=',1)
            ->get();
        if($supp->count() == 0)
        {
            Supplier::insert(['SuppDesc'=>$request->SuppDesc,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($supp);
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
        $suu = Supplier::where('id',$id)
        ->first();

        return Response($suu);
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
        $supp = Supplier::find($id);
        $supp->SuppDesc=$request->SuppDesc;
        $supp->save();

        return Response($supp);
    }

    public function delete($id)
    {
        $supp = Supplier::find($id);
        $supp->todelete = 0;
        $supp->save();
        return Response($supp);
    }
}
