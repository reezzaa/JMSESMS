 <table id="qclient-datatable" class="table table-vcenter table-striped table-bordered table-hover">
      <thead>
      <tr>
        <th class="text-center">MATERIAL</th>
       <th class="text-center">DATE</th>
       <th class="text-center">METHOD</th>
       <th class="text-center">QUANTITY</th>
        <th class="text-center">SUPPLIER</th>
        <th class="text-center">DELIVERY RECEIPT</th>
    </tr>
      </thead>
      <tbody id="">
      @foreach($fmat as $fmat)
    <tr>
      <td class="text-center">
        {{$fmat->MaterialName}}
      </td>
      <td class="text-center">
        {{\Carbon\Carbon::parse($fmat->date)->toDayDateTimeString()}}
      </td>
      <td class="text-center">
        {{$fmat->method}}
      </td>
      <td class="text-center">
        {{$fmat->quantity}}
      </td>
      <td class="text-center">
        {{$fmat->SuppDesc}}
      </td>
      <td class="text-center">
        {{$fmat->number}}
      </td>
    </tr>
    @endforeach     
      </tbody>
<script>$(function(){ TablesDatatables.init(); });</script>
   

