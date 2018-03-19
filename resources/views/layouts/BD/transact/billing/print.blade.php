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
    table {
    border-collapse: collapse;
    width:100%;
  }
 td, .cust
 {
  height:20px;
    padding: 2px;

 }
 .hes
 {
  border: 1px solid black;
 }

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
    <table class="table-borderless">

                            <td class="col-md-1">
                                  <th style="width:100px;height: 100px">&nbsp;</th>
                                  
                            </td>
                            <td class="col-md-9 text-center">
                               
                                            <strong style="font-family: 'Bodoni Black';font-size: 120%;"> MACHINE SHOP & ENGINEERING SERVICES</strong>  
                                        <br>
                                           
                            </td>
                            
                            <td class="col-md-2"><br><br>
                              <p style="font-size: 100%;"><b>{{$id}}</b></p>
                            </td>
                          </table>
                            <p class="text-center"><b style="font-family: 'Bodoni Black';font-size: 120%;">SERVICE INVOICE</b></p>
                          @foreach($print as $print)
                          <table class=" table-borderless" >
                            <tr>
                              <td class="col-md-8 cust" style="text-align: left"><b>Customer: </b>{{$print->strCompClientName}}<br></td>
                              <td class="col-md-4 cust" style="text-align: left"><b>Date:</b> {{\Carbon\Carbon::parse($print->s_date)->toFormattedDateString()}}</td>
                              <td></td>

                            </tr>
                            <tr>
                              <td class="col-md-8 cust" style="text-align: left"><b>Address:</b> {{$print->strCompClientAddress}} {{$print->strCompClientCity}}, {{$print->strCompClientProv}}</td>
                              <td ></td>
                              <td ></td>

                            </tr>
                            <tr>
                              <td class="col-md-4 cust" style="text-align: left"><b>TIN:</b> {{$print->strCompClientTIN}}</td>
                              <td class="col-md-4 cust" style="text-align: left"><b>Terms:</b>{{$print->term}} {{$print->termdate}}</td>
                              <td class="col-md-4 cust"></td>

                            </tr>
                          </table>
                          
                          <br>
                          <table class="table-bordered hes">
                            <tr class="hes" >
                              <th class="col-md-8 text-center hes">DESCRIPTION</th>
                              <th class="col-md-4 text-center hes">AMOUNT</th>
                            </tr>
                            <tr  class="hes">
                              <td  class="hes" style="height: 300px" class="text-center">
                                  <h4><b>{{$print->desc}}</b></h4>

                              </td>
                              <td  class="hes" style="height: 300px" class="text-center">
                                  <h4>PHP {{$print->s_amount}}</h4>

                              </td>
                            </tr>
                            <tr  class="hes">
                              <td  class="hes" style="text-align: right"> TOTAL AMOUNT DUE</td>
                              <td class="text-center hes"> <b>PHP {{$print->subtotal}}</b></td>
                            </tr>
                            <tr>
                              <td   class="hes" style="text-align: right;"> VALUE ADDED TAX</td>
                              <td class="text-center hes"> <b>PHP {{$print->taxValue}}</b></td>
                            </tr>
                            <tr>
                              <td  class="hes" style="text-align: right;"> TOTAL </td>
                              <td class="text-center hes"> <b>PHP {{$print->s_amount}}</b></td>

                            </tr>

                          </table>
                          <br>
                          <table class="table-borderless">
                            <tr>
                              <th style="width: 135%"></th>
                            <th style="width: 65%"></th>
                            </tr>
                            <tr>
                              <td style="text-align: right;padding: 8px"><b>Prepared By:</b></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;padding: 8px"><b>Received By:</b></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td style="text-align: right;padding: 8px"><b>Date Received:</b></td>
                              <td></td>
                            </tr>
                          </table>
                          <br>
                           
                          @endforeach 
                        <br>


  </body>
</html>