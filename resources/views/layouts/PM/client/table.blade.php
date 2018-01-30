<table id="client-datatable" class="table table-vcenter table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Logo</th>
      <th class="text-center">Company Name</th>
      <th class="text-center">Client's Representative</th>
      <th class="text-center">Location</th>
      <th class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody id="client-list">
     @foreach($clients as $client)
    <tr id="strCompClientID">
        <td class="text-center">
            {{ $client->strCompClientID }}
        </td>
        <td class="text-center">
            <img src="{{url('images', $client->strCompClientImage)}}" style="width:80px;">
        </td>
        <td class="text-center">
            {{ $client->strCompClientName }}
        </td>
        <td class="text-center">
            {{ $client->strCompClientRepresentative }}<br>
            <i>{{ $client->strCompClientPosition }}</i>
        </td>
        <td class="text-center">
             {{ $client->strCompClientCity }},  {{ $client->strCompClientProv }}
        </td>
        <td>
          <div class="text-center">
            <a href="client/{{$client->strCompClientID}}"><button class="btn btn-alt btn-info" data-toggle="tooltip" data-placement="top" data-original-title="View"><span class="gi gi-eye_open"></span></button></a>
            <a href="client/{{$client->strCompClientID}}/edit"><button class="btn btn-alt btn-warning" data-toggle="tooltip" data-placement="top" data-original-title="Edit"> <span class="gi gi-pencil"></span></button></a>
            {{ Form::open(array('url'=>'pm/client/'.$client->strCompClientID)) }}
              {{ Form::hidden('_method','DELETE') }}
              <button type="submit" class="btn btn-alt btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete"><span class="gi gi-bin"></span></button>
            {{ Form::close() }}
          </div>
      </td>
      </tr>
    @endforeach
  </tbody>
</table>
<script>$(function(){ TablesDatatables.init(); });</script>