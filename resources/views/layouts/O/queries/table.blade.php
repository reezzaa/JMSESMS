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
      @foreach($mat as $mat)
    <tr>
      <td class="text-center">
        {{$mat->MaterialName}}
      </td>
      <td class="text-center">
        {{\Carbon\Carbon::parse($mat->date)->toDayDateTimeString()}}
      </td>
      <td class="text-center">
        {{$mat->method}}
      </td>
      <td class="text-center">
        {{$mat->quantity}}
      </td>
      <td class="text-center">
        {{$mat->SuppDesc}}
      </td>
      <td class="text-center">
        {{$mat->number}}
      </td>
    </tr>
    @endforeach     
      </tbody>
<script>$(function(){ TablesDatatables.init(); });</script>
   

