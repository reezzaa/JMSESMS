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
    <table class="table-bordered text-center" id="tblheader"  style="width: 100%">

                            <td class="text-center" style="width: 100%">
                               
                                            <strong style="font-family: 'Bodoni Black';font-size: 120%;text-indent: 20%"> MACHINE SHOP & ENGINEERING SERVICES </strong>  
                                        <br>
                                            
                            </td>
                            
                            
                            </table>
                            <h4><b>PROGRESS REPORT</b></h4>
                            <h5 style="text-align: right"><b>Reporting Date: {{\Carbon\Carbon::parse($from)->toFormattedDateString()}} - {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</b></h5>
                            @foreach($header as $header)
                               <h5 style="text-align: left"><b>Contract Name: {{$header->name}}</b> <br><b>Contract Order #: {{$header->co}}</b></h5>
                            @endforeach
                            <table width="100%" id="tbl">
                              <thead>
                                <tr id="ge">
                                        <th class="col" style="width: 60%">ACTIVITY / TASK</th>
                                        <th class="col" style="width: 20%">% of WORK COMPLETED</th>
                                        <th class="col" style="width:20%">DATE</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($print as $pri)
                                      <tr>
                                      <td class="col">{{$pri->ServTask}}</td>
                                      <td class="col">{{$pri->percent}} %</td>
                                      <td class="col">{{\Carbon\Carbon::parse($pri->date)->toFormattedDateString()}}</td>
                                        
                                      </tr>
                                      @endforeach
                                      
                                    </tbody>
                                
                              </table>
                              

  </body>
</html>