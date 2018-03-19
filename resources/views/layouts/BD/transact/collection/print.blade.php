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
 .he
 {
  border: 1px solid black;
  font-size: 10px;
  padding: 0px;
 }
  .hue
 {
  font-size: 12px;
  padding: 1px;
  align-content: left;
 }


  img {
    height: 70px;
    width: 70px;
  }
 /* .he {
    font-size: 9;
  }*/
</style>
  </head>
  <body><br><br>
    <table>
        <td>
          <table>
            <thead>
              <tr>
                <th class="text-center he">PARTICULARS</th>
                <th class="text-center he">AMOUNT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($getpayment as $gp)
              <tr><td  class="he"></td><td  class="he"></td></tr>
              <tr><td  class="he"></td><td  class="he"></td></tr>
              <tr><td  class="he"></td><td  class="he"></td></tr>
              <tr>
                <td class="he">Vatable Sales</td>
                <td class="he">{{$gp->subtotal}}</td>
              </tr>
              <tr>
                <td class="he">VAT Exempt Sales</td>
                <td class="he"></td>
              </tr>
              <tr>
                <td class="he">Zero-Rated Sales</td>
                <td  class="he"></td>
              </tr>
              <tr>
                <td class="he">Total Sales</td>
                <td class="he">{{$gp->subtotal}}</td>
              </tr>
              <tr>
                <td class="he">VAT Amount</td>
                <td class="he">{{$tax}}</td>
              </tr>
              <tr>
                <td class="he">Total Amount</td>
                <td class="he">{{$gp->amount}}</td>
              </tr>
              <tr>
                <td class="he">TOTAL AMOUNT DUE</td>
                <td class="he">{{$gp->amount}}</td>
              </tr>
            </tbody>
          </table>
          <table>
            <tr>
                <td class="he"><b>FORM OF PAYMENT</b></td>
              </tr>
              @if($gp->BankID == 0 )
                <tr>
                  <td class="he">[/]Cash     []Check</td>
                </tr>
                <tr>
                  <td class="he">Bank</td>
                </tr>
                <tr>
                  <td class="he">Check Number</td>
                </tr>
                <tr>
                  <td class="he">Check Date</td>
                </tr>
              @else
                <tr>
                  <td class="he">[]Cash     [/]Check</td>
                </tr> 
                <tr>
                  <td class="he" style="text-align: left">Bank: {{$gp->BankName}}</td>
                </tr>
                <tr>
                  <td class="he" style="text-align: left">Check Number: {{$gp->cheque_no}}</td>
                </tr>
                <tr>
                  <td class="he" style="text-align: left">Check Date: {{$gp->v_date}}</td>
                </tr>   
             @endif
              @endforeach

          </table>
        </td>
        <td>
          <table>
                      
                      <td class="col-md-9 text-center">
                               <br><br>
                                            <strong style="font-family: 'Bodoni Black';font-size: 100%;text-indent: 10%"> MACHINE SHOP & ENGINEERING SERVICES</strong>  
                                        <br>
                                           
                      </td> 
               <td class="col-md-2"><br><br>
                        <p style="font-size: 80%;"><b>{{$id}}</b></p>
                </td>
          </table>
              <table>
                @foreach($getpayment as $getp)
                <tr>
                  <td style=" text-align: left">
                    <p><b style="font-family: 'Bodoni Black';font-size: 100%;">OFFICIAL RECEIPT</b></p> 
                    </td>
                </tr>
                <tr>
                  <td  class="hue" style=" text-align: right">
                    Date: {{\Carbon\Carbon::parse($getp->v_date)->toFormattedDateString()}}
                  </td>
                </tr>
                <tr>
                  <td class="hue">
                    <p style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RECEIVED from {{$getp->strCompClientName}} with TIN {{$getp->strCompClientTIN}} and address at {{$getp->strCompClientAddress}} {{$getp->strCompClientCity}}, {{$getp->strCompClientProv}} engaged in a business style of <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>, the sum of <u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u>(P {{$getp->amount}}) in  full payment for {{$getp->inv}}. </p>
                  </td>
                </tr>
                <tr>
                  <td class="hue" style=" text-align: right" >
                    By:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                    <i>Cashier/Authorized Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i>
                  </td>
                </tr>
                <tr><td></td></tr>
                <tr><td></td></tr>
                <tr>
                  <td class="text-center hue">THIS OFFICIAL RECEIPT SHALL BE VALID FOR FIVE(5) YEARS FROM DATE OF ATP</td>
                </tr>
                @endforeach
              </table>
          
        </td>
    </table>
                         
  </body>
</html>