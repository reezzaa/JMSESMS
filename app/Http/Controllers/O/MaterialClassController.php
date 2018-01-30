<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\MaterialClass;
use App\MaterialType;
use Response;
class MaterialClassController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:operations');
    }

    public function index()
    {
        $mattype = MaterialType::where('status','=',1)->where('todelete','=',1)
            ->pluck('MatTypeName','id');
        return view('layouts.O.mainte.materialclass.index', compact('mattype'));
    }

    public function readByAjax()
    {
        $matclass = MaterialClass::join('tblMaterialType', 'tblMaterialClass.MatTypeID', '=', 'tblMaterialType.id')
            ->select('tblMaterialClass.*','tblMaterialType.MatTypeName')
            ->orderby('tblMaterialClass.id')
            ->where('tblMaterialClass.todelete','=',1)
            ->where('tblMaterialType.todelete','=',1)
            ->where('tblMaterialType.status','=',1)
            ->get();
        
        return view('layouts.O.mainte.materialclass.table', ['matclass'=>$matclass,'mattype'=>MaterialType::where('status','=',1)->where('todelete','=',1)->pluck('MatTypeName', 'id')]);
    }
    

    public function store(Request $request)
    {
        $classnameAdd = MaterialClass::where('MatClassname', '=', $request->MatClassname )
            ->where('todelete','=',1)
            ->get();
        if($classnameAdd->count() == 0)
        {
            MaterialClass::insert(['MatTypeID'=>$request->MatTypeID,
                'MatClassName'=>$request->MatClassname,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($classnameAdd);
        }
    }
    
    public function edit($classID)
    {
        $matclasse = MaterialClass::find($classID);
        return Response($matclasse);
    }

    public function update(Request $request, $classID)
    {
            $updclass = MaterialClass::find($classID);
            $updclass->MatClassname = $request->MatClassname;
            $updclass->MatTypeID = $request->MatTypeID;
            $updclass->save();
            return Response($updclass);
        
    }

    public function checkbox($id)
    {
        $matclass = MaterialClass::find($id);
        if ($matclass->status) {
            $matclass->status=0;
        }
        else{
            $matclass->status=1;
        }
        $matclass->save();
    }

    public function delete($classID)
    {
        $matclass = MaterialClass::find($classID);
        $matclass->todelete = 0;
        $matclass->save();
        return Response($matclass);
    }
}	
