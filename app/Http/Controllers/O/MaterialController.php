<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\O;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\MaterialClass;
use App\MaterialType;
use App\Material;
use App\MaterialPrice;
use App\GroupUOM;
use App\DetailUOM;
use App\MatPrice;
use Response;
use DB;
use Carbon\carbon;
class MaterialController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:operations');
    }

    public function index()
    {
        return view('layouts.O.mainte.material.index', ['mattype'=> MaterialType::where('status','=',1)->where('todelete','=',1)->get(),'groupuom'=> GroupUOM::where('status','=',1)->where('todelete','=',1)->get()]);
    }
    public function readByAjax()
    {
        $material = Material::join('tblMaterialClass', 'tblMaterial.MatClassID', 'tblMaterialClass.id')
            ->join('tblMaterialType', 'tblMaterialClass.MatTypeID', 'tblMaterialType.id')
            ->join('tblDetailUOM', 'tblMaterial.MatUOM', 'tblDetailUOM.id')
            ->leftjoin('tblmatdate','tblmatdate.MatID','tblMaterial.id')
            ->select('tblMaterial.id as matID','tblMaterial.*','tblMaterialClass.MatClassName','tblDetailUOM.*','tblMaterialType.*')
            ->orderby('tblMaterial.id')
            ->where('tblMaterial.todelete','=',1)
            ->get();

            foreach ($material as $key ) {
             $key->MaterialUnitPrice=number_format($key->MaterialUnitPrice,2);
                
            }
        $type = MaterialType::where('status','=',1)->where('todelete','=',1)->get(); 
        $class = MaterialClass::where('status','=',1)->where('todelete','=',1)->get(); 
        $guom = GroupUOM::where('status','=',1)->where('todelete','=',1)->get(); 
        $duom = DetailUOM::where('status','=',1)->where('todelete','=',1)->get(); 
         
        return view('layouts.O.mainte.material.table', compact('material','type','class','guom','duom'));
    }

    public function getMatClass($id)
    {
        $matcat = MaterialClass::where('status',1)->where('todelete',1)->where('MatTypeID',$id)->orderby('id')->get();
        
        return Response($matcat);
    }
    public function getMatUOM($id)
    {
        $detailuom = DetailUOM::where('GroupUOMID',$id)->orderby('id')->get();
        
        return Response($detailuom);
    }
    public function getMatSymbol($id)
    {
        $detailSymbol = DetailUOM::where('id',$id)->get();
        
        return Response($detailSymbol);
    }
    

    public function store(Request $request)
    {
        $matAdd = Material::where('MatClassID', '=', $request->MatClassID )
            ->where('MaterialName', '=', $request->MaterialName )
            ->where('MatUOM', '=', $request->MatUOM )
            ->where('MaterialBrand', '=', $request->MaterialBrand )
            ->where('MaterialSize', '=', $request->MaterialSize )
            ->where('MaterialColor', '=', $request->MaterialColor )
            ->where('MaterialDimension', '=', $request->MaterialDimension )
            ->where('MaterialUnitPrice', '=', $request->MaterialUnitPrice )
            ->where('todelete','=',1)
            ->get();

        if($matAdd->count() == 0)
        {
            $updmat = new Material();
            $updmat->MaterialName = $request->MaterialName;
            $updmat->MatClassID = $request->MatClassID;
            $updmat->MatUOM = $request->MatUOM;
            $updmat->MaterialBrand = $request->MaterialBrand;
            $updmat->MaterialSize = $request->MaterialSize;
            $updmat->MaterialColor = $request->MaterialColor;
            $updmat->MaterialDimension = $request->MaterialDimension;
            $updmat->MaterialUnitPrice = $request->MaterialUnitPrice;
            $updmat->status =1;
            $updmat->todelete = 1;
            $updmat->date = Carbon::now();
            $updmat->save();

            $var = new MatPrice();
            $var->MatID = $updmat->id;
            $var->date = Carbon::now();
            $var->up_mat = $request->MaterialUnitPrice;
            $var->save();

            return Response($matAdd);
        }
    }

    public function edit($classID)
    {
        $material = Material::join('tblMaterialClass', 'tblMaterial.MatClassID', 'tblMaterialClass.id')
            ->join('tblMaterialType', 'tblMaterialClass.MatTypeID', 'tblMaterialType.id')
            ->join('tblDetailUOM', 'tblMaterial.MatUOM', 'tblDetailUOM.id')
            ->join('tblGroupUOM','tblGroupUOM.id','tblDetailUOM.GroupUOMID')
            ->select('tblMaterial.id as matID','tblMaterial.*','tblMaterialClass.MatClassName','tblMaterialType.id as mattypeID','tblMaterialType.MatTypeName','tblGroupUOM.id as groupID','tblGroupUOM.GroupUOMText','tblDetailUOM.DetailUOMText')
            ->orderby('tblMaterial.id')
            ->where('tblMaterial.todelete','=',1)
            ->where('tblMaterial.id',$classID)
            ->get();
            // dd($material);
        return Response($material);
    }
    // public function findClass()
    // {
    //     $class = MaterialClass::where('status','=',1)
    //     ->where('todelete','=',1)
    //     ->orderby('id')
    //     ->get(); 
    //     return Response($class);
    // }

    public function update(Request $request, $matID)
    {
        
            $updmat = Material::find($matID);
            $updmat->MaterialName = $request->MaterialName;
            $updmat->MatClassID = $request->MatClassID;
            $updmat->MatUOM = $request->MatUOM;
            $updmat->MaterialBrand = $request->MaterialBrand;
            $updmat->MaterialSize = $request->MaterialSize;
            $updmat->MaterialColor = $request->MaterialColor;
            $updmat->MaterialDimension = $request->MaterialDimension;
            $updmat->MaterialUnitPrice = $request->MaterialUnitPrice;
            $updmat->date = Carbon::now();
            $updmat->save();

         $specdescAdd = Material::where('MaterialUnitPrice', $request->MaterialUnitPrice )
            ->where('date', $request->date)
            ->where('id',$matID)
            ->where('todelete','=',1)
            ->get();
         if($specdescAdd->count() == 0)
        {
            $var = new MatPrice();
            $var->MatID = $matID;
            $var->date = Carbon::now();
            $var->up_mat = $request->MaterialUnitPrice;
            $var->save();
        }

         return Response($updmat);
      
    }
    public function show($id)
    {
         $spece = Material::leftjoin('tblmatdate','tblmatdate.MatID','tblmaterial.id')
        ->select('tblMaterial.MaterialName','tblMaterial.id','tblmatdate.up_mat','tblmatdate.date')
        ->where('tblMaterial.id',$id)
        ->orderby('tblmatdate.date','DESC')
        ->get();
        // dd($spece);
        return Response($spece);
    }
   
    public function checkbox($id)
    {
        $mat = Material::find($id);
        if ($mat->status) {
            $mat->status=0;
        }
        else{
            $mat->status=1;
        }
        $mat->save();
    }

    public function delete($matID)
    {
        $mat = Material::find($matID);
        $mat->todelete = 0;
        $mat->save();
        return Response($mat);
    }
}