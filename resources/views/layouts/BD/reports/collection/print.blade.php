<html>
  <head>
    <style type="text/css">

  body {
   text-align: center;
    font-family: 'Calibri','sans-serif';
  }
  table, th, td {
   text-align: center;
    padding: 5px;
    border: 0px solid black;
  }
    #tblheader {
    border-collapse: collapse;
    width:80%;
  }
  table {
    border-collapse: collapse;
    width:100%;
  }
 #tbl, #ge,.col {
    border-collapse: collapse;
    border: 1px solid black;
    font-family: 'Calibri','sans-serif';
    font-size: 10;
        
  }
 #ge {
    background-color: green;
    color: white;
    font-size: 10;
  }
  
    tr:nth-child(even) {background-color: #E6E6E6}



  img {
    height: 100px;
    width: 100px;
  }
 /* .he {
    font-size: 9;
  }*/
</style>
  </head>
  <body><br><br>
    <table class="table-borderless" id="tblheader" style="width: 100%">

                            
                            <td class="col-md-5 text-center">
                               
                                          <strong style="font-family: 'Bodoni Black';font-size: 120%; ">MACHINE SHOP & ENGINEERING SERVICES </strong>  
                                        <br>
                            </td>
                            
                            
                            </table>
                            <h4><b>OVERALL COLLECTIBLE MONITORING FROM {{\Carbon\Carbon::parse($from)->toFormattedDateString()}} TO {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</b></h4>
                            <table width="100%" id="tbl">
                                <thead>
                                  <tr id="ge">
                                          <th class="col">CLIENT</th>
                                          <th class="col">DATE OF INVOICE</th>
                                          <th class="col">PROJECT TITLE</th>
                                          <th class="col">SI #</th>
                                          <th class="col">CO/PO #</th>
                                          <th class="col">INVOICE AMOUNT</th>
                                          <th class="col">VATABLE</th>
                                          <th class="col">TAX</th>
                                          <th class="col">RECOUPMENT</th>
                                          <th class="col">RETENTION</th>
                                          <th class="col">DATE RECEIVED</th>
                                          <th class="col">TERMS</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                         @foreach($proj as $p)
                                              @foreach($down as $sd)
                                                @if($sd->c_id==$p->con_id)
                                                @if($sd->invoice==$p->serv_id)
                                                <tr>
                                                  <td class="col he">{{$p->strCompClientName}}</td>
                                                  <td class="col he">{{\Carbon\Carbon::parse($p->s_date)->toFormattedDateString()}}</td>
                                                  <td class="col he">{{$p->desc}}</td>
                                                  <td class="col he">{{$p->serv_id}}</td>
                                                  <td class="col he">{{$p->co}}</td>
                                                  <td class="col he">Php {{$p->s_amount}}</td>
                                                  <td class="col he">Php {{$sd->initialtax}}</td>
                                                  <td class="col he">Php {{$sd->taxValue}}</td>
                                                  <td class="col he">--</td>
                                                  <td class="col he">--</td>
                                                  <td class="col he">
                                                    @if($p->OrID==$null)
                                                      <span></span>
                                                    @else
                                                      {{\Carbon\Carbon::parse($p->p_date)->toFormattedDateString()}}
                                                    @endif
                                                  </td>
                                                  <td class="col he">{{$p->term}} {{$p->termdate}} </td>
                                                </tr>

                                                @else
                                                @foreach($pb as $t)
                                                  @if($t->invoice==$p->serv_id)
                                                  <tr>
                                                  <td class="col he">{{$p->strCompClientName}}</td>
                                                  <td class="col he">{{\Carbon\Carbon::parse($p->s_date)->toFormattedDateString()}}</td>
                                                  <td class="col he">{{$p->desc}}</td>
                                                  <td class="col he">{{$p->serv_id}}</td>
                                                  <td class="col he">{{$p->co}}</td>
                                                  <td class="col he">Php {{$p->s_amount}}</td>
                                                  <td class="col he">Php {{$t->initialtax}}</td>
                                                  <td class="col he">Php {{$t->taxValue}}</td>
                                                  <td class="col he">Php {{$t->recValue}}</td>
                                                  <td class="col he">Php {{$t->retValue}}</td>
                                                  <td class="col he">
                                                    @if($p->OrID==$null)
                                                      <span></span>
                                                    @else
                                                      {{\Carbon\Carbon::parse($p->p_date)->toFormattedDateString()}}
                                                    @endif
                                                  </td>
                                                  <td class="col he">{{$p->term}} {{$p->termdate}} </td>
                                                </tr>
                                                  @endif
                                              @endforeach
                                                @endif

                                              @endif
                                              @endforeach
                                            @foreach($inc as $in)
                                              @if($in->c_id == $p->con_id)
                                                @if($in->invoice == $p->serv_id)
                                                <tr>
                                                  <td class="col he">{{$p->strCompClientName}}</td>
                                                  <td class="col he">{{\Carbon\Carbon::parse($p->s_date)->toFormattedDateString()}}</td>
                                                  <td class="col he">{{$p->desc}}</td>
                                                  <td class="col he">{{$p->serv_id}}</td>
                                                  <td class="col he">{{$p->co}}</td>
                                                  <td class="col he">Php {{$p->s_amount}}</td>
                                                  <td class="col he">Php {{$p->subtotal}}</td>
                                                  <td class="col he"></td>
                                                  <td class="col he">--</td>
                                                  <td class="col he">--</td>
                                                  <td class="col he">
                                                    @if($p->OrID==$null)
                                                      <span></span>
                                                    @else
                                                      {{\Carbon\Carbon::parse($p->p_date)->toFormattedDateString()}}
                                                    @endif
                                                  </td>
                                                  <td class="col he">{{$p->term}} {{$p->termdate}} </td>
                                                </tr>
                                                @endif
                                              @endif
                                            @endforeach

                                            @endforeach -->

                                      </tbody>
                                    </table>
                                     <p style=" text-indent: 40%">
                                       <span>  <b>Total: </b> PHP {{$total}}</span>  &nbsp;&nbsp; <b>Collected: PHP {{$collected}}</b> &nbsp;&nbsp; <b>Remaining: <u>PHP {{$amount_tobe}}</u></b>
                                     </p>
                                     <p style=" text-indent: 60%">

                                     <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
                  
                                     <p style=" text-indent: 60%">
                                       <span>  <b>Prepared By: </b> &nbsp; 
                                     </p>
                                     


  </body>
</html>