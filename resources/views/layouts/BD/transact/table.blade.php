<table id="billbycontract-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Contract</th>
      <th class="text-center">Name</th>
      <th class="text-center">Client</th>
      <th class="text-center">Amount</th>
      <th style="width: 280px" class="text-center">Controls</th>

    </tr>
  </thead>
<tbody>
  @foreach($var as $var)
  <tr>
    <td class="text-center">{{$var->conid}}</td>
    <td class="text-center">{{$var->name}}</td>
    <td class="text-center">{{$var->strCompClientName}}</td>
    <td class="text-center"> ₱ {{$var->amount}}</td>
    <td class="text-center">
           <a href=" {{ route('billing.show', $var->conid)}}"><button class="btn btn-alt btn-md btn-success" value="{{$var->conid}}"><span class="gi gi-new_window"> </span> Billing</button></a>
           <a href=" {{ route('collection.show', $var->conid)}}"><button class="btn btn-alt btn-md btn-info" value="{{$var->conid}}"><span class="gi gi-new_window"> </span> Collection</button></a>
        </td>
    
  </tr>
  @endforeach
</tbody>
</table>   
<br>     
<script>$(function(){ TablesDatatables.init(); });</script>
