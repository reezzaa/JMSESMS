<?php

namespace App\Http\Controllers\O;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;
use Response;

class BankController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:operations');
    }

    public function index()
    {
        $bankcheck = Bank::where('status','=',1)->where('todelete','=',1)
            ->get();
        return view('layouts.O.mainte.bank.index', compact('bankcheck'));
    }

    public function readByAjax()
    {
        $bank = Bank::where('todelete','=',1)
        ->get();
        // dd($bank);
        return view('layouts.O.mainte.bank.table', compact('bank'));
    }
    

    public function store(Request $request)
    {
        $bankAdd = Bank::where('BankName', '=', $request->BankName )
            ->where('todelete','=',1)
            ->get();
        if($bankAdd->count() == 0)
        {
            Bank::insert(['BankName'=>$request->BankName,
                'todelete'=>1,
                'status'=>1
                ]);
            return Response($bankAdd);
        }
    }
    
    public function edit($id)
    {
        $bankSearch = Bank::find($id);
        return Response($bankSearch);
    }

    public function update(Request $request, $id)
    {
        
            $updclass = Bank::find($id);
            $updclass->BankName = $request->BankName;
            $updclass->save();
            return Response($updclass);

        

    }

    public function checkbox($id)
    {
        $bankstat = Bank::find($id);
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
        $bankDel = Bank::find($id);
        $bankDel->todelete = 0;
        $bankDel->save();
        return Response($bankDel);
    }
}
