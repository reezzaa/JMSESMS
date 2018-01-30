<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ServicesOffered;
use Response;

class ServicesOfferedController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth:operations');
    }
      public function index()
    {
        $serv = ServicesOffered::where('status','=',1)->where('todelete','=',1)
            ->get();
        return view('layouts.O.mainte.services.index', compact('serv'));
    }

    public function readByAjax()
    {
        $serve = ServicesOffered::where('todelete','=',1)
        ->get();
        // dd($serve);
        return view('layouts.O.mainte.services.table', compact('serve'));
    }
    

    public function store(Request $request)
    {
        $serve = ServicesOffered::where('ServiceOffName', '=', $request->ServiceOffName )
            ->where('todelete','=',1)
            ->get();
        if($serve->count() == 0)
        {
            ServicesOffered::insert(['ServiceOffName'=>$request->ServiceOffName,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($serve);
        }
    }
    
    public function edit($id)
    {
        $se = ServicesOffered::find($id);
        return Response($se);
    }

    public function update(Request $request, $id)
    {
        $servupd= ServicesOffered::where('ServiceOffName', '=', $request->ServiceOffName )
                ->where('todelete','=',1)
                ->get();
        if($servupd>count() == 0)
        {
            $updclass = ServicesOffered::find($id);
            $updclass->ServiceOffName = $request->ServiceOffName;
            $updclass->save();
            return Response($updclass);
        } 
    }

    public function checkbox($id)
    {
        $servstat = ServicesOffered::find($id);
        if ($servstat->status) {
            $servstat->status=0;
        }
        else{
            $servstat->status=1;
        }
        $servstat->save();
    }

    public function delete($id)
    {
        $servDel = ServicesOffered::find($id);
        $servDel->todelete = 0;
        $servDel->save();
        return Response($servDel);
    }
}
