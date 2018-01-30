<table id="billbycontract-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Contract</th>
      <th class="text-center">Client</th>
      <th class="text-center">Amount</th>
      <th style="width: 280px" class="text-center">Controls</th>

    </tr>
  </thead>
<tbody>
  <tr>
    <td class="text-center">CO111111</td>
    <td class="text-center">Sample</td>
    <td class="text-center">8929787382</td>
    <td class="text-center">
           <a href=" {{ route('bd.trans.bill')}}"><button class="btn btn-alt btn-md btn-success"><span class="gi gi-new_window"> </span> Billing</button></a>
           <a href=" {{ route('bd.trans.collect')}}"><button class="btn btn-alt btn-md btn-info"><span class="gi gi-new_window"> </span> Collection</button></a>
           <a href=" {{ route('billingcollection.create')}}"><button class="btn btn-alt btn-md btn-warning"><span class="gi gi-new_window"> </span> Incurrences</button></a>
        </td>
    
  </tr>
</tbody>
</table>   
<br>     
<script>$(function(){ TablesDatatables.init(); });</script>
