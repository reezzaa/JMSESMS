<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\Supplier;
use App\Material;
use App\Stocks;
use App\StockCard;
use Carbon\carbon;
use Config;
use DB;
use Response;
class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:budgetdepartment');
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = DB::table('tblcontracttask')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        ->leftjoin('tblstocks','tblstocks.MatID','tblmaterial.id')
        ->select('tblstocks.over','tblstocks.under','tblstocks.stocks','tblmaterial.MaterialName','tblservmaterial.quantity','tbldetailuom.UOMUnitSymbol','tblmaterial.id as mat_id','tblservtask.ServTask','tblservmaterial.total as mat_total')
        ->where('tblcontracttask.status','!=',2)
        ->where('tblcontracttask.id',$id)
        ->get();

        // $supp = DB::table('tblcontracttask')
        // ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        // ->join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        // ->select('tblsupplier.*')
        // ->where('tblcontracttask.status','!=',2)
        // ->where('tblcontracttask.id',$id)
        // ->get();

         $task = DB::table('tblcontracttask')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->where('tblcontracttask.id',$id)
        ->where('tblcontracttask.status','!=',2)
        ->select('tblservtask.ServTask')
        ->first();
        return view('layouts.BD.transact.stock.index',compact('stock','task','id','supp'));
    }
    public function getSupp($id)
    {
         $supp=Material::join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        ->where('tblmaterial.id',$id)
        ->select('tblsupplier.id','tblsupplier.SuppDesc')
        ->get();
        // dd($mate);

        return Response($supp);
    }
    public function getSuppPrice($id)
    {
         $supp=Material::join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        ->where('tblsupplier.id',$id)
        ->select('tblmaterial.id as mat_id','tblmaterial.MaterialUnitPrice')
        ->get();
        // dd($mate);

        return Response($supp);
    }
    public function openStock($id)
    {
        // $card =  DB::table('tblcontracttask')
        // ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        // ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        // ->join('tblstockcard','tblstockcard.MatID','tblmaterial.id')
        // ->join('tblstocks','tblstocks.MatID','tblmaterial.id')
        // ->leftjoin('tblsupplier','tblsupplier.id','tblstockcard.SuppID')
        // ->where('tblmaterial.id',$id)
        // ->select('tblstockcard.*','tblmaterial.MaterialName','tbldetailuom.UOMUnitSymbol','tblsupplier.SuppDesc')
        // ->orderby('tblstockcard.date','DESC')
        // ->get();

        // $current = DB::table('tblstocks')
        // ->select('')

        // $name =  DB::table('tblcontracttask')
        // ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        // ->where('tblmaterial.id',$id)
        // ->select('tblmaterial.MaterialName')
        // ->first();

        // return view('layouts.BD.transact.stock.stock',['name'=>$name,'card'=>$card,'supp'=> Supplier::where('status','=',1)->where('todelete','=',1)->pluck('SuppDesc', 'id')]);
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
        $mate=DB::table('tblmaterial')
        ->leftjoin('tblstocks','tblstocks.MatID','tblmaterial.id')
        ->join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        ->select('tblstocks.stocks','tblmaterial.id as MatID','tblmaterial.MaterialName','tblmaterial.MaterialUnitPrice','tblmaterial.date','tblsupplier.*')
        ->where('tblmaterial.id',$id)
        ->get();
        return Response::json($mate);
    }
  // public function storeThat(Request $request)
  //   {
  //       //
  //       $sto=Stocks::find($request->matd);
  //       $sto->stocks=($request->quantityd-$request->quant_addd);
  //       $sto->date=Carbon::now(Config::get('app.timezone'));
  //       $sto->save();

  //       $var = new StockCard();
  //       $var->MatID=$request->matd;
  //       $var->quantity=$request->quant_addd;
  //       $var->date=Carbon::now(Config::get('app.timezone'));
  //       $var->method='OUT';
  //       $var->stock=($request->quantityd-$request->quant_addd);
  //       $var->cost = $request->price_sub;
  //       $var->totalcost = ($request->quant_addd * $request->price_sub);
  //       $var->save();

  //        return redirect(route('stockadjustment.index'));


  //   }
      public function storeThis(Request $request)
    {
        //
        $stock = DB::table('tblcontracttask')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->select('tblservmaterial.total')
        ->where('tblcontracttask.status','!=',2)
        ->where('tblcontracttask.id',$request->myId)
        ->where('tblservmaterial.MatID',$request->thisId)
        ->first();
        // dd($stock);

        $sto=Stocks::find($request->thisId);
        if($sto==null)
        {
            $sto = new Stocks();
            $sto->MatID = $request->thisId;
            $sto->stocks=($request->quantitys+$request->quant_add);
            $sto->date=Carbon::now(Config::get('app.timezone'));
            $sto->cost = $request->matprices;
            $sto->totalcost = $request->matprices* $request->quant_add;
            if($stock->total < $sto->totalcost)
            {
            $sto->over = $sto->totalcost - $stock->total;
            $sto->under = null;
            }
            elseif($stock->total > $sto->totalcost)
            {
                $sto->over = null;
                $sto->under = $sto->totalcost - $stock->total;
            }
             $sto->save();
            
        }
        else
        {
             $sto=Stocks::find($request->thisId);
            $sto->MatID = $request->thisId;
            $sto->TaskID = $request->myId;
            $sto->stocks=($request->quantitys+$request->quant_add);
            $sto->date=Carbon::now(Config::get('app.timezone'));
            $sto->cost = $request->matprices;
            $sto->totalcost = $request->matprices* $request->quant_add;
            if($stock->total < $sto->totalcost)
            {
            $sto->over = $sto->totalcost - $stock->total;
            $sto->under = null;
            }
            elseif($stock->total > $sto->totalcost)
            {
                $sto->over = null;
                $sto->under = $sto->totalcost - $stock->total;
            }
            else
            {
                $sto->over = null;
                $sto->under = null;
             
            }
            $sto->save();
        }

        if($request->orig_price != $request->matprices)
        {
            $mat = Material::find($request->thisId);
            $mat->MaterialUnitPrice = $request->matprices;
            $mat->save();
        }
       

        $var = new StockCard();
        $var->MatID=$request->thisId;
        $var->TaskID = $request->myId;
        $var->quantity=$request->quant_add;
        $var->date=Carbon::now(Config::get('app.timezone'));
        $var->method='IN';
        $var->number = $request->delrecs;
        $var->stock=($request->quantitys+$request->quant_add);
        $var->cost = $request->matprices;
        $var->totalcost = ($request->quant_add * $request->matprices);
        $var->save();

       

         return redirect()->route('stock.show',$request->myId);
        // return Response($sto);


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
