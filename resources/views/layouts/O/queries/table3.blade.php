 <table id="qclient-datatable" class="table table-vcenter table-striped table-bordered table-hover">
      <thead>
      <tr>
      <th class="text-center">Material</th>
      <th class="text-center">Date</th>
      <th class="text-center">Status</th>
      <th class="text-center">Quantity</th></tr>
      </thead>
      <tbody id="">
          @foreach($omat as $omat)
    <tr>
      <td class="text-center">
        {{$omat->strMaterialName}}
      </td>
      <td class="text-center">
        {{\Carbon\Carbon::parse($omat->dtmStockDate)->toDayDateTimeString()}}
      </td>
      <td class="text-center">
        {{$omat->strStockMethod}}
      </td>
      <td class="text-center">
        {{$omat->intStock}}
      </td>
    </tr>
    @endforeach     
      </tbody>
<script>$(function(){ TablesDatatables.init(); });</script>
   
