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
    font-size: 9;
        
  }
 #ge {
    background-color: green;
    color: white;
    font-size: 10;
  }
  
    tr:nth-child(even) {background-color: #E6E6E6}



  img {
    height: 90px;
    width: 90px;
  }
 /* .he {
    font-size: 9;
  }*/
</style>
  </head>
  <body><br><br>
    <table class="table-borderless" style="width: 100%">

                           
                            <td class="text-center" >
                               
                                            
                                            <strong style="font-family: 'Bodoni Black';font-size: 120%;"> MACHINE SHOP & ENGINEERING SERVICES </strong>  
                                        <br>
                            </td>
                           
                            
                            </table>
                            <h4><b>STOCK USAGE REPORT FROM {{\Carbon\Carbon::parse($from)->toFormattedDateString()}} TO {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</b></h4>
                            <table width="100%" id="tbl">
                              <thead>
                                <tr id="ge">
                                        <th class="col" style="width: 10%"></th>
                                        <th class="col" style="width: 15%">CONTRACT</th>
                                        <th class="col" style="width: 20%">ACTIVITY/TASK</th>
                                        <th class="col" style="width: 20%">MATERIALS</th>
                                        <th class="col" style="width:20%">STOCKS</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($print as $pri)
                                      <tr>
                                      <td class="col">{{$pri->con_id}}</td>
                                      <td class="col">{{$pri->name}} </td>
                                      <td class="col">
                                        @foreach($print_details as $pd)
                                          @if($pd->c_id == $pri->con_id)
                                            {{$pd->ServTask}} <br>
                                          @endif
                                        @endforeach 
                                      </td>
                                      <td>
                                        @foreach($print_details as $pd)
                                          @if($pd->c_id == $pri->con_id)
                                            @foreach($mats as $m)
                                              @if($m->s_id == $pd->s_id)
                                              {{ $m->MaterialName}}  <br>
                                              @endif
                                            @endforeach
                                          @endif
                                        @endforeach 
                                      </td>
                                      <td>
                                        @foreach($print_details as $pd)
                                          @if($pd->c_id == $pri->con_id)
                                                @foreach($stock as $s)
                                                  @if($s->s_id == $pd->s_id)
                                                    {{ $s->quantity}} <br>
                                                  @endif
                                                @endforeach
                                          @endif
                                        @endforeach 
                                      </td>
                                        
                                      </tr>
                                      @endforeach
                                      
                                    </tbody>
                                
                              </table>
                              

  </body>
</html>