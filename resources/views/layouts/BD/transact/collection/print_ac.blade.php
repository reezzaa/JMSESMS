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

</style>
  </head>
  <body>
    <br><br>

          <h3 class="text-center" style="font-family: Bodoni Black MT"><b> ACKNOWLEDGEMENT RECEIPT</b></h3><hr>
        @foreach($getdata as $gd)               
         
             <h5 style="font-family: Arial; font-size: 16px; text-align: left;margin-left: 10%">TO: {{$gd->strCompClientName}}</h5>
             <h5 style="font-family: Arial; font-size: 16px; text-align: left;margin-left: 10%">DATED: {{\Carbon\Carbon::parse($gd->v_date)->toFormattedDateString()}}</h5> <br>
             <p style="font-family: Arial; font-size: 16px; text-indent: 25px;text-align: left; margin-left: 10%">Received the amount of PHP {{$gd->amount}} as a full payment for {{$gd->inv}}, evidenced by the following details: </p>
                <ul>
                  <li style="font-family: Arial; font-size: 16px;margin-left: 15%; text-align: left"> Bank: {{$gd->BankName}}</li>
                  
                  <li style="font-family: Arial; font-size: 16px;margin-left: 15%; text-align: left"> Check Number: {{$gd->cheque_no}}</li>
                </ul><br>

           
         @endforeach
       <p style="font-family: Arial; font-size: 14px; text-indent: 5px;margin-left: 10%;text-align: left">  Received By:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
                    <i style="margin-left: 15%;">Cashier/Authorized Personnel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></p>
          
                         
  </body>
</html>