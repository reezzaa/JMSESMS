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
                               <strong style="font-family: 'Bodoni Black';font-size: 120%;"> MACHINE SHOP & ENGINEERING SERVICES</strong>  
                                        <br>
                            </td>
                           
                            
                            </table>
                            <h4><b>STATEMENT OF ACCOUNTS FOR CLIENT {{$clients->strCompClientName}} FROM {{\Carbon\Carbon::parse($from)->toFormattedDateString()}} TO {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</b></h4>
                            
                            <table width="100%" id="tbl">
                              <thead>
                                <tr id="ge">
                                        <th class="col">SI #</th>
                                        <th class="col">DESCRIPTION</th>
                                        <th class="col">INVOICE AMOUNT</th>
                                        <th class="col">BILLING DATE</th>
                                        <th class="col">DUE DATE</th>
                                        <th class="col">STATUS</th>
                                        <th class="col">OR #</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($soa as $soa)
                                    <tr>
                                      <td class="col">{{$soa->serv_id}}</td>
                                      <td class="col">{{$soa->desc}}</td>
                                      <td class="col">Php {{$soa->s_amount}}</td>
                                      <td class="col">{{\Carbon\Carbon::parse($soa->date)->toFormattedDateString()}}</td>
                                      <td class="col">{{\Carbon\Carbon::parse($soa->duedate)->toFormattedDateString()}}</td>   
                                      <td class="col">
                                        @if(($soa->s_status)==1)
                                        <h5 style="color: #18A15E;font-weight: bold;"> Paid</h5>
                                        @elseif(($soa->s_status)==0)
                                        <h5 style="color: #E28E00;font-weight: bold;"> Unpaid</h5>
                                        @endif
                                      </td>
                                      <td class="col he">
                                        @if($soa->OrID==$null)
                                          <span></span>
                                        @else
                                        {{$soa->OrID}}
                                        @endif
                                     </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                
                              </table>
                              <p style=" text-indent: 60%">

                                     <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
                  
                                     <p style=" text-indent: 60%">
                                       <span>  <b>Prepared By: </b> &nbsp;  
                                     </p>


  </body>
</html>