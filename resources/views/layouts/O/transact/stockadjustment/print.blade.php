<html>
	<head>
		<style type="text/css">

  body {
   text-align: center;
    font-family: 'Calibri','sans-serif';
  }
  table, th, td {
   text-align: center;
    padding: 6px;
    border: 1px solid black;
  }
    table {
    border-collapse: collapse;
  }
 #ge {
    background-color: green;
    color: white;
    font-size: 12;
  }
  
    tr:nth-child(even) {background-color: #E6E6E6}

/*  img {
    height: 100px;
    width: 100px;
  }
  .he {
    font-size: 9;
  }*/
</style>
	</head>
	<body><br><br>
		<h3><strong>{{$matname->MaterialName}} stocks from {{\Carbon\Carbon::parse($from)->toFormattedDateString()}} to {{\Carbon\Carbon::parse($to)->toFormattedDateString()}} </strong></h3>
		 <table class="table table-vcenter table-striped table-borderless "  style=" width: 100%">
		            <thead>
		              <tr id="ge">
		                <th class="text-center col-md-2">DATE</th>
		                <th class="text-center col-md-2">IN</th>
		                <th class="text-center col-md-2">OUT</th>
		                <th class="text-center col-md-2">BALANCE</th>
		                <th class="text-center col-md-2">UNIT COST</th>
		                <th class="text-center col-md-2">TOTAL COST</th>
		                <th class="text-center col-md-2">SUPPLIER</th>
		                <th class="text-center col-md-2">DELIVERY RECEIPT</th>
		              </tr>
		            </thead>
		            <tbody  class="text-center">
		              @foreach($mate as $mate)
		              <tr>
		              	<td>{{\Carbon\Carbon::parse($mate->date)->toFormattedDateString()}}</td>
		              	<td>
		              		@if($mate->method=='IN')
		              		{{$mate->quantity}} {{$mate->UOMUnitSymbol}}
		              		@else
		              		-
		              		@endif
		              	</td>
		              	<td>
		              		@if($mate->method=='OUT')
		              		{{$mate->quantity}} {{$mate->UOMUnitSymbol}}
		              		@else
		              		-
		              		@endif
		              	</td>
		              	<td>
		              		{{$mate->stock}} {{$mate->UOMUnitSymbol}}
		              	</td>
		              	<td>
		              		Php {{$mate->cost}}
		              	</td>
		              	<td>
		              		Php {{$mate->totalcost}}
		              	</td>
		              	<td>
		              		 {{$mate->SuppDesc}}
		              	</td>
		              	<td>
		              		 {{$mate->number}}
		              	</td>
		              </tr>
		              @endforeach
		            </tbody>
		          </table>

	</body>
</html>