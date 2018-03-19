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
</style>
  </head>
  <body><br><br>
    <table class="table-borderless" id="tblheader" style="width: 100%">

                            
                            <td class="text-center" >
                               
                                            <strong style="font-family: 'Bodoni Black';font-size: 120%;"> MACHINE SHOP & ENGINEERING SERVICES </strong>  
                                        <br>
                                            
                            </td>
                            
                            
                            </table>
                              <h4><b>REFERENCES OF BILLING FOR {{$header->name}}</b></h4>
                            <h5 style="text-align: left"><b>Client: {{$header->strCompClientName}}</b> <br><b>Total Contract Amount: {{$header->c_amount}}</b></h5>
                              <table width="100%" id="tbl">
                                <thead>
                                  <tr id="ge">
                                    <th class="col"></th>
                                    <th class="col">INVOICE NO.</th>
                                    <th class="col">INVOICE AMOUNT</th>
                                    <th class="col">30% RECOUPMENT TO DP</th>
                                    <th class="col">10% RETENTION</th>
                                    <th class="col">SUB-TOTAL</th>
                                    <th class="col">VATABLE AMOUNT</th>
                                    <th class="col">TAX</th>
                                    <th class="col">REMARKS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                          <tr>
                                          <td class="col">
                                            30% DP 
                                          </td>
                                          <td class="col">
                                           {{$down->invoice}} 
                                          </td>
                                          <td class="col">
                                            {{$down->d_amount}}
                                          </td>
                                          <td class="col">
                                            --
                                          </td>
                                          <td class="col">
                                            -- 
                                          </td>
                                          <td class="col">
                                            {{$down->d_amount}} 
                                          </td>
                                          <td class="col">
                                            {{$down->initialtax}} 
                                          </td>
                                          <td class="col">
                                            {{$down->taxValue}}
                                          </td>
                                          <td class="col">
                                            @if(($down->status)==0)
                                           <span style="color: #D64F40;font-weight: bold;"> Unpaid</span>
                                            @else
                                            <span style="color: #18A15E;font-weight: bold;"> Paid</span>
                                            @endif
                                          </td>
                                          </tr>
                                          @foreach($pb as $p)
                                            <tr>

                                              <td class="col">
                                               {{$p->Mode}} % PB 
                                              </td>
                                              <td class="col">
                                               {{$p->invoice}} 
                                              </td>
                                              <td class="col">
                                                {{$p->pb_amount}}
                                              </td>
                                              <td class="col">
                                                {{$p->recValue}}
                                              </td>
                                              <td class="col">
                                                {{$p->retValue}} 
                                              </td>
                                              <td class="col">
                                                {{$p->initial}} 
                                              </td>
                                              <td class="col">
                                                {{$p->initialtax}} 
                                              </td>
                                              <td class="col">
                                                {{$p->taxValue}}
                                              </td>
                                              <td class="col">
                                                @if(($p->status)==0)
                                               <span style="color: #D64F40;font-weight: bold;"> Unpaid</span>
                                                @else
                                                <span style="color: #18A15E;font-weight: bold;"> Paid</span>
                                                @endif
                                              </td>
                                            </tr>
                                          @endforeach


                                </tbody>
                              </table>
                              <h5 style="text-align: left"><b>ADDITIONAL EXPENSES / INCURRENCES</b></h5>
                              <table width="100%" id="tbl">
                                <thead>
                                  <tr id="ge">
                                    <th class="col"></th>
                                    <th class="col" style="color: green">INVOICE NO.</th>
                                    <th class="col" style="color: green">INVOICE AMOUNT</th>
                                    <th class="col" style="color: green">30% RECOUPMENT TO DP</th>
                                    <th class="col" style="color: green">10% RETENTION</th>
                                    <th class="col" style="color: green">SUB-TOTAL</th>
                                    <th class="col" style="color: green">VATABLE AMOUNT</th>
                                    <th class="col" style="color: green">TAX</th>
                                    <th class="col" style="color: green">REMARKS</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($inc as $inc)
                                            <tr>

                                              <td class="col">
                                              </td>
                                              <td class="col">
                                               {{$inc->invoice}} 
                                              </td>
                                              <td class="col">
                                                {{ $inc->desc }}
                                              </td>
                                              <td class="col">
                                                {{$inc->inc_amount}}
                                              </td>
                                              <td class="col">
                                              </td>
                                              <td class="col">
                                              </td>
                                              <td class="col">
                                              </td>
                                              <td class="col">
                                              </td>
                                              <td class="col">
                                                
                                              </td>
                                            </tr>
                                          @endforeach
      
                                         


                                </tbody>
                              </table>
                              <p style=" text-indent: 40%">
                                       <span>  <b>Total: </b> <u>PHP {{$header->c_amount}}</u></span> 
                                     </p>
                               <p style=" text-indent: 60%">

                                     <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
                  
                                     <p style=" text-indent: 60%">
                                       <span>  <b>Prepared By: </b> &nbsp;  
                                     </p>

  </body>
</html>