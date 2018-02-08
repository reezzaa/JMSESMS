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
      @foreach($suppmat as $suppmat)
    <tr>
      <td class="text-center">
        {{$suppmat->MaterialName}}
      </td>
      <td class="text-center">
        {{\Carbon\Carbon::parse($suppmat->date)->toDayDateTimeString()}}
      </td>
      <td class="text-center">
        {{$suppmat->method}}
      </td>
      <td class="text-center">
        {{$suppmat->quantity}}
      </td>
      <td class="text-center">
        {{$suppmat->SuppDesc}}
      </td>
      <td class="text-center">
        {{$suppmat->number}}
      </td>
    </tr>
    @endforeach     
      </tbody>
<script>$(function(){ TablesDatatables.init(); });</script>
   

