<table id="receive-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Contract Name</th>
      <th class="text-center">Client</th>
      <th class="text-center">From</th>
      <th class="text-center">Through</th>
      <th class="text-center">Status</th>
      <th  class="text-center"></th>
    </tr>
  </thead>
   <tbody id="bank-list">
    @foreach($cont as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
            {{ $u->conid }}
        </td>
        <td class="text-center">
            {{ $u->name }}
        </td>
       <td class="text-center">
            {{ $u->strCompClientName }}
        </td>
        <td class="text-center">
        {{\Carbon\Carbon::parse($u->from)->toFormattedDateString()}}
        </td>
        <td class="text-center">
        {{\Carbon\Carbon::parse($u->to)->toFormattedDateString()}}

        </td>
        <td class="text-center">
              @if($u->status==0)
                  <label class="label label-danger">No Downpayment</label>
              @elseif($u->status==1)
                  <label class="label label-primary">On Going</label>
              @elseif($u->status==2)
                  <label class="label label-warning">For Final Inspection</label>
              @elseif($u->status==1)
                  <label class="label label-success">Terminated</label>
              @endif
        </td>
        <td class="text-center">
            <a href="/pm/contract/{{$u->conid}}" class="btn btn-alt btn-primary edit_supp" value = "{{$u->conid}}">Open</a>
            
        </td>
       
    </tr>
    @endforeach
  </tbody>
</table>        
    
<script>$(function(){ TablesDatatables.init(); });</script>