<?php

namespace App\Http\Controllers\BD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contract;
use App\ContractTask;
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
        $var = Contract::join('tblclient','tblclient.strCompClientID','tblcontract.ClientID')
        // ->where('tblcontract.status','!=',0)
        ->select('tblcontract.*','tblcontract.id as conid','tblclient.strCompClientName')
        ->get();

        return view('layouts.BD.transact.stock.table', compact('var'));

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
        $stock = DB::table('tblcontracttask')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->select('tblservmaterial.total','tblservmaterial.id as smat_id','tblmaterial.id as mat_id')
        ->where('tblcontracttask.active','!=',2)
        ->where('tblcontracttask.id',$request->myId)
        ->where('tblservmaterial.id',$request->thisId)
        ->first();
        // dd($stock);

        // $tot = ContractTask::join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblstocks','tblstocks.ServMatID','tblservmaterial.id')
        // ->select('tblstocks.totalcost')
        // ->where('tblcontracttask.id',$request->myId)
        // ->where('tblservmaterial.id',$request->thisId)
        // ->first();
        // // dd($tot);

        $sto=Stocks::find($stock->smat_id);
        // dd(count($sto));
        if(count($sto)==0)
        {
          
            $sto = new Stocks();
            $sto->ServMatID = $stock->smat_id;
            $sto->stocks=$request->quant_add;
            $sto->date=Carbon::now(Config::get('app.timezone'));
            $sto->cost = $request->matprices;
            $sto->totalcost = $sto->stocks* $sto->cost;
            // dd($request->quant_add);
            if($stock->total < $sto->totalcost)
            {
            $sto->over = $sto->totalcost - $stock->total;
            $sto->under = null;
            }
            elseif($stock->total > $sto->totalcost)
            {
                $sto->over = null;
                $sto->under =  $stock->total- $sto->totalcost ;
            }
            $sto->mode = 1;
             $sto->save();
            
          
            
        }
        // // dd($request->quantitys);
        elseif($sto->mode == 1)
        { 
            //5
            $temp = 0;
            $temp = $request->matprices* $request->quant_add;//5000
            $sto=Stocks::find($stock->smat_id);
            $sto->stocks=($request->quantitys+$request->quant_add);// 5 + 5
            $sto->date=Carbon::now();
            $sto->cost = $request->matprices;//1000
            $sto->totalcost =  $request->totcost + $temp;//5000 + 5000 = 10000
            // dd($sto->totalcost - $stock->total);
            if($stock->total < $sto->totalcost)
            {
              // dd($sto->totalcost - $stock->total);
            $sto->over = $sto->totalcost - $stock->total;
            $sto->under = null;

            }
            elseif($stock->total > $sto->totalcost)
            {

                $sto->over = null;
                $sto->under = $stock->total - $sto->totalcost;

            }
            else
            {
                $sto->over = null;
                $sto->under = null;

             
            }
            $sto->mode = 1;
               $sto->save();

        }

        if($request->orig_price != $request->matprices)
        {
            $mat = Material::find($stock->mat_id);
            $mat->MaterialUnitPrice = $request->matprices;
            $mat->save();
        }
       

        $var = new StockCard();
        $var->ServMatID = $stock->smat_id;
        $var->quantity=$request->quant_add;
        $var->date=Carbon::now(Config::get('app.timezone'));
        $var->method='IN';
        $var->number = $request->delrecs;
        $var->stock=($request->quantitys+$request->quant_add);
        $var->cost = $request->matprices;
        $var->totalcost = ($request->quant_add * $request->matprices);
        $var->save();

       

         return redirect()->route('stock.show', $request->myId);
        // return Response($sto);

    }

    public function task($id)
    {
      $task = DB::table('tblcontract')
       ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
       ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
       // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
       ->select('tblservtask.ServTask','tblcontracttask.id as conid')
       ->where('tblcontracttask.active',"!=",2)
       ->where('tblcontract.id',$id)
       ->get();

       return view('layouts.BD.transact.stock.table2',compact('task'));
    }
    public function show($id)
    {
        $stock = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->leftjoin('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->leftjoin('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        ->leftjoin('tblstocks','tblstocks.ServMatID','tblservmaterial.id')
        ->select('tblstocks.over','tblstocks.under','tblstocks.stocks','tblmaterial.MaterialName','tbldetailuom.UOMUnitSymbol','tblmaterial.id as mat_id','tblservmaterial.id as smat_id','tblservmaterial.quantity','tblservmaterial.total')
        ->where('tblcontracttask.active','!=',2)
        ->where('tblcontracttask.id',$id)
        // ->where('tblcontract.id',$id)
        // ->where('tblcontract.id','Contract0000001')
        ->get();
         foreach ($stock as $key ) {
                     $key->total=number_format($key->total,2);      
                    }  
        // dd($stock);
        // $supp = DB::table('tblcontracttask')
        // ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        // ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        // ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        // ->join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        // ->select('tblsupplier.*')
        // ->where('tblcontracttask.status','!=',2)
        // ->where('tblcontracttask.id',$id)
        // ->get();
         $supp=Supplier::select('tblsupplier.id','tblsupplier.SuppDesc')
         ->get();

         $task = DB::table('tblcontracttask')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->where('tblcontracttask.id',$id)
        ->where('tblcontracttask.active','!=',2)
        ->select('tblservtask.ServTask')
        ->first();
        return view('layouts.BD.transact.stock.index',compact('stock','id','supp'));
    }
    public function getSupp()
    {
         $supp=Supplier::select('tblsupplier.id','tblsupplier.SuppDesc')
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
       $getStock = DB::table('tblcontract')
        ->join('tblcontracttask','tblcontracttask.ContractID','tblcontract.id')
        ->join('tblservtask','tblservtask.id','tblcontracttask.ServID')
        ->join('tblservmaterial','tblservmaterial.ServID','tblservtask.id')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        ->join('tbldetailuom','tbldetailuom.id','tblmaterial.MatUOM')
        ->leftjoin('tblstockcard','tblstockcard.ServMatID','tblservmaterial.id')
        ->select('tblstockcard.*','tblmaterial.MaterialName','tbldetailuom.UOMUnitSymbol','tblmaterial.id as mat_id','tblservmaterial.id as smat_id','tblsupplier.SuppDesc')
        ->where('tblcontracttask.active','!=',2)
        ->where('tblservmaterial.id',$id)
        // ->where('tblcontract.id',$id)
        // ->where('tblcontract.id','Contract0000001')
        ->get();
         foreach ($getStock as $key ) {
                     $key->totalcost=number_format($key->totalcost,2);      
                     $key->cost=number_format($key->cost,2);      
                    }
          return Response($getStock);  
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
        $mate=DB::table('tblservmaterial')
        ->join('tblmaterial','tblmaterial.id','tblservmaterial.MatID')
        ->leftjoin('tblstocks','tblstocks.ServMatID','tblservmaterial.id')
        ->join('tblsupplier','tblsupplier.id','tblmaterial.SuppID')
        ->select('tblstocks.stocks','tblmaterial.id as MatID','tblmaterial.MaterialName','tblmaterial.MaterialUnitPrice','tblmaterial.date','tblsupplier.*','tblservmaterial.id as ServMatID','tblstocks.totalcost')
        ->where('tblservmaterial.id',$id)
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
