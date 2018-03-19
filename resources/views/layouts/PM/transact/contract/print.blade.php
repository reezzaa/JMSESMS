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
  font-size: 13px;
 }
 .this
 {
  font-size: 13px;
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
        <h4 class="text-center">  <b style="font-family: 'Bodoni Black';font-size: 120%;"> PROJECT TURNOVER REPORT</b></h4><br> <br>  
                          <table class="table-borderless this">
                          <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px">PROJECT TITLE: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> {{$print->name}} </u> </td>
                          </tr><br> 
                          <tr>  
                            <td style="width: 10%; text-align: left;text-indent: 30px">PROJECT LOCATION: </td>
                            <td  style="width: 20%; text-align: left;text-indent: 30px"><u> {{$print->location}} </u> </td>
                          </tr><br> 
                          <tr>  
                            <td style="width: 10%; text-align: left;text-indent: 30px">CONTRACTOR:  </td>
                            <td  style="width: 20%; text-align: left;text-indent: 30px"><u> </u> </td>
                          </tr><br> 
                          </table>
                         

                          <h5 class="text-center">  <b> PROGRESS INSPECTION</b></h5>
                          <table class="hes"> 
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px">  Official Date of Start: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u>{{\Carbon\Carbon::parse($print->officialstartdate)->toFormattedDateString()}}  </u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px">  Date of Inspection: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> {{\Carbon\Carbon::parse($print->start)->toFormattedDateString()}}</u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px"> Target % Completion: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> {{$print->target}} % </u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px"> Actual % Completion: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> {{$print->actual}} %</u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px"> Ahead/ Delay %: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> </td>
                            </tr>
                          </table>
                          <h5 class="text-center">  <b> FINAL INSPECTION</b></h5>
                          <table class="hes"> 
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px">  Date of Final Inspection: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> {{\Carbon\Carbon::parse($print->officialenddate)->toFormattedDateString()}} </u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px"> Actual Date of Completion: </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u> 
                               {{\Carbon\Carbon::parse($print->enddate)->toFormattedDateString()}} </u> </td>
                            </tr>
                            <tr>  
                            <td style="width: 10%; text-align: left; text-indent: 30px"> Ahead/Delayed (days): </td>
                            <td  style="width: 20%; text-align: left; text-indent: 30px"><u>
                             @if($print->status==1)
                              On-time
                              @elseif($print->status==2)
                              Ahead
                              @else
                                Delayed
                              @endif</u> </td>
                            </tr>
                          </table><br>  <br>  
                
                           <table class="hes"> 
                            <tr>  
                            <td style="width: 10%; height: 150px; text-align: left; text-indent: 30px">  INSPECTED BY: (<i>  Signature over Printed Name/Date</i>) </td>
                            <td  style="width: 20%;height: 150px; text-align: left; text-indent: 30px"><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> <br> &nbsp;&nbsp;&nbsp;&nbsp; Contractor</td>
                            <td  style="width: 20%;height: 150px; text-align: left; text-indent: 30px"><u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>  {{$print->strCompClientRepresentative}}</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br> Client's Representative </td>
                            </tr>
                          </table>
                         
                          <br>
                           
                        <br>


  </body>
</html>