<?php

namespace App\Http\Controllers\O;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Material;
use App\Supplier;
use Carbon\carbon;
use Config;
use Response;
use App\StockCard;
use App\Stocks;
use PDF;

class StockController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:operations');
    }
    public function index()
    {
        //
         return view('layouts.O.transact.stockadjustment.index',['mat'=> Material::where('status','=',1)->where('todelete','=',1)->pluck('MaterialName', 'id'),'supp'=> Supplier::where('status','=',1)->where('todelete','=',1)->pluck('SuppDesc', 'id')]);
    }

    public function readByAjax()
    {
       $stock = DB::table('tblmaterial')
        ->join('tblstocks','tblstocks.MatID','tblmaterial.id')
        ->join('tblmaterialclass','tblmaterialclass.id','tblmaterial.MatClassID')
        ->join('tblmaterialtype','tblmaterialtype.id','tblmaterialClass.MatTypeID')
        ->select('tblmaterial.MaterialName','tblstocks.stocks','tblstocks.date as date_s','tblmaterial.id','tblmaterial.MaterialUnitPrice')
        ->where('tblmaterial.status',1)
        ->where('tblmaterial.todelete',1)
        ->where('tblmaterialclass.status',1)
        ->where('tblmaterialclass.todelete',1)
        ->where('tblmaterialtype.status',1)
        ->where('tblmaterialtype.todelete',1)
        ->get();

        
        
        return view('layouts.O.transact.stockadjustment.table',['stock'=> $stock,
            'mat'=> Material::where('status','=',1)->where('todelete','=',1)->pluck('MaterialName', 'id'),'supp'=> Supplier::where('status','=',1)->where('todelete','=',1)->pluck('SuppDesc', 'id')]);   
    }
    public function store(Request $request)
    {
        //
        $var = new StockCard();
        $var->MatID=$request->mat;
        $var->quantity=$request->quantity;
        $var->date=Carbon::now(Config::get('app.timezone'));
        $var->method='IN';
        $var->stock=$request->quantity;
        $var->SuppID = $request->supp;
        $var->number = $request->delrec;
        $var->cost = $request->price;
        $var->totalcost = ($request->quantity * $request->price);
        $var->save();

        $sto = new Stocks();
        $sto->MatID= $request->mat;
        $sto->stocks=$request->quantity;
        $sto->date=Carbon::now(Config::get('app.timezone'));
        $sto->save();

       

         return response::json($sto);
    }
     public function storeThat(Request $request)
    {
        //
        $sto=Stocks::find($request->matd);
        $sto->stocks=($request->quantityd-$request->qtyd);
        $sto->date=Carbon::now(Config::get('app.timezone'));
        $sto->save();

        $var = new StockCard();
        $var->MatID=$request->matd;
        $var->quantity=$request->qtyd;
        $var->date=Carbon::now(Config::get('app.timezone'));
        $var->method='OUT';
        $var->stock=($request->quantityd-$request->qtyd);
        $var->cost = $request->price_sub;
        $var->totalcost = ($request->qtyd * $request->price_sub);
        $var->save();

         return redirect(route('stockadjustment.index'));


    }
      public function storeThis(Request $request)
    {
        //
        $sto=Stocks::find($request->mats);
        $sto->stocks=($request->quantitys+$request->qty);
        $sto->date=Carbon::now(Config::get('app.timezone'));
        $sto->save();

        $var = new StockCard();
        $var->MatID=$request->mats;
        $var->quantity=$request->qty;
        $var->date=Carbon::now(Config::get('app.timezone'));
        $var->method='IN';
        $var->SuppID = $request->supp;
        $var->number = $request->delrecs;
        $var->stock=($request->quantitys+$request->qty);
        $var->cost = $request->price_add;
        $var->totalcost = ($request->qty * $request->price_add);
        $var->save();

       

         return redirect(route('stockadjustment.index'));


    }

    public function edit($id)
    {
        //
        $mate=DB::table('tblmaterial')
        ->join('tblstocks','tblstocks.MatID','tblmaterial.id')
        ->where('tblmaterial.id',$id)
        ->select('tblstocks.stocks','tblstocks.MatID','tblmaterial.MaterialName','tblmaterial.MaterialUnitPrice')
        ->first();
        return response::json($mate);
    }
    public function show($id)
    {
        $mate=DB::table('tblmaterial')
        ->join('tblstockcard','tblstockcard.MatID','tblmaterial.id')
        ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        ->where('tblmaterial.id',$id)
        ->select('tblstockcard.*','tblmaterial.MaterialName','tbldetailuom.UOMUnitSymbol','tblsupplier.SuppDesc')
        ->orderby('tblstockcard.date','DESC')
        ->limit(15)
        ->get();
        foreach ($mate as $key ) {
             $key->cost=number_format($key->cost,2);
             $key->totalcost=number_format($key->totalcost,2);
            }

        return response::json($mate);
    }
    public function findPrice($id)
    {
         $mate=DB::table('tblmaterial')
        ->where('tblmaterial.id',$id)
        ->select('tblmaterial.MaterialUnitPrice')
        ->get();
        return response::json($mate);
    }

    public function printStockCard(Request $request)
    {
        // $company = DB::table('tblCompanyUtil')
        // ->select('tblCompanyUtil.*')
        // ->first();
        $from=$request->datStart;
        $to=$request->datEnd;

        $matname = DB::table('tblmaterial')
        ->join('tblstockcard','tblstockcard.MatID','tblmaterial.id')
        ->where('tblmaterial.id',$request->myId)
        ->first();

       $mate=DB::table('tblmaterial')
        ->join('tblstockcard','tblstockcard.MatID','tblmaterial.id')
        ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        ->where('tblmaterial.id',$request->myId)
        ->whereBetween('tblstockcard.date',[$request->datStart,$request->datEnd])
        ->select('tblstockcard.*','tblmaterial.MaterialName','tbldetailuom.UOMUnitSymbol','tblsupplier.SuppDesc')
        ->orderby('tblstockcard.date','DESC')
        ->get();

       foreach ($mate as $key ) {
             $key->cost=number_format($key->cost,2);
             $key->totalcost=number_format($key->totalcost,2);
            }

        $pdf = PDF::loadView('layouts.O.transact.stockadjustment.print',compact('mate','matname','from','to'))->setPaper('letter','portrait');      
        
        $pdfName="myPDF.pdf";
        // $location=public_path("docs/$pdfName");
        // $pdf->save($location); 
        return $pdf->stream(); 
  }

  public function queries()
  {
      $getMat = DB::table('tblMaterial')
        ->select('tblMaterial.MaterialName','tblMaterial.id')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->orderby('id')
        ->get();
      $getSupp = DB::table('tblsupplier')
        ->select('tblsupplier.SuppDesc','tblsupplier.id')
        ->where('tblsupplier.status',1)
        ->where('tblsupplier.todelete',1)
        ->orderby('id')

        ->get();

        return view('layouts.O.queries.index',['getMat'=>$getMat,'getSupp'=>$getSupp]);
  }
   public function readQueries()
    {
        $mat = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.MatID','tblMaterial.id')
        ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        ->select('tblMaterial.*','tblStockCard.*','tblsupplier.SuppDesc')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->orderby('tblStockCard.date')
        ->get();

        return view('layouts.O.queries.table',['mat'=>$mat]);
    }

    public function findMate($id)
    {
        $fmat = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.MatID','tblMaterial.id')
        ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        ->select('tblMaterial.*','tblStockCard.*','tblsupplier.SuppDesc')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->where('tblMaterial.id',$id)
        ->orderby('tblStockCard.date')
        ->get();

        return view('layouts.O.queries.table1',['fmat'=>$fmat]);
    }
    public function findSupp($id)
    {
        $suppmat = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.MatID','tblMaterial.id')
        ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        ->select('tblMaterial.*','tblStockCard.*','tblsupplier.SuppDesc')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->where('tblsupplier.id',$id)
        ->orderby('tblStockCard.date')
        ->get();

        return view('layouts.O.queries.table2',['suppmat'=>$suppmat]);
    }
    public function readByAjax2()
    {
        $imat = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.intStockMatID','tblMaterial.intMaterialID')
        ->select('tblMaterial.*','tblStockCard.*')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->where('tblStockCard.strStockMethod','IN')
        ->orderby('tblStockCard.dtmStockDate')
        ->get();

        return view('layouts.queries.Stock.table2',['imat'=>$imat]);
    }
    public function readByAjax3()
    {
        $omat = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.intStockMatID','tblMaterial.intMaterialID')
        ->select('tblMaterial.*','tblStockCard.*')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->where('tblStockCard.strStockMethod','OUT')
        ->orderby('tblStockCard.dtmStockDate')
        ->get();

        return view('layouts.queries.Stock.table3',['omat'=>$omat]);
    }
    public function findStartDate($id)
    {
        $getsdate = Carbon::parse($id);
        $getsdate->toDateString();
        $sdate = DB::table('tblMaterial')
        ->join('tblStockCard','tblStockCard.intStockMatID','tblMaterial.intMaterialID')
        ->select('tblMaterial.*','tblStockCard.*')
        ->where('tblMaterial.status',1)
        ->where('tblMaterial.todelete',1)
        ->where('tblStockCard.dtmStockDate',$getsdate)
        ->orderby('tblStockCard.dtmStockDate','DESC')
        ->get();

        return view('layouts.queries.Stock.table4',['sdate'=>$sdate]);

    }
}
