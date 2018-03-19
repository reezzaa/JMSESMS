@extends('layouts.PM.queries.transact_main')
@section('head')
<script>

</script>
@endsection
@section('sidebar')
  <!-- Main Sidebar -->
  <div id="sidebar">
      <!-- Wrapper for scrolling functionality -->
      <div class="sidebar-scroll">
          <!-- Sidebar Content -->
          <div class="sidebar-content">
              <!-- Icon for user -->
              @include('layouts.PM.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.PM.sidebar')
              <!-- END Sidebar Navigation -->
          </div>
          <!-- END Sidebar Content -->
      </div>
      <!-- END Wrapper for scrolling functionality -->
  </div>
  <!-- END Main Sidebar -->
@endsection

@section('content')
 <div class="content-header">
      <div class="header-section">
        <h4>
            <i class="fa fa-search"> </i> Contract Queries <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Queries</a></li>
      <li><a>Contract</a></li>
  </ol>
<div class="block">
    <div class="table-responsive">
                            <table id="base-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fa fa-cube"></i><br />Contract Number</th>
                                        <th class="text-center"><i class="fa fa-file-text"></i><br />Contract Name</th>
                                        <th class="text-center"><i class="gi gi-user"></i><br />Client</th>
                                        <th class="text-center"><i class="fa fa-calendar"></i><br />Start Date</th>
                                        <th class="text-center"><i class="fa fa-book"></i><br />Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($contracts as $contract)
                                        <tr>
                                            <td><center>{{ $contract -> id }}</center></td>
                                            <td><center>{{ $contract -> name }}</center></td>
                                            <td><center>{{ $contract -> clientname }} ({{ $contract -> clientID }})</center></td>
                                            <td><center>{{ $contract -> from }}</center></td>
                                            @if ($contract -> status == 0)
                                                <td><center>No Downpayment</center></td>
                                            @elseif ($contract -> status == 1)
                                                <td><center>On-Going</center></td>
                                            @elseif ($contract -> status == 2)
                                                <td><center>Initial Inspection / Turnover</center></td>
                                            @elseif ($contract -> status == 3)
                                                <td><center>Terminated</center></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
</div>
    
@endsection


@section('page-function')
<script>$(function(){ TablesDatatables.init(); });</script>

    <script type="text/javascript">
        // App.datatables();


        $("#base-datatable").dataTable({
            dom: 'Bfrtip',
            columnDefs: [ { orderable: true } ],
            colReorder: true,
            pageLength: 10, 
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        $('.dataTables_filter input').attr('placeholder', 'Search');
    </script>
@endsection