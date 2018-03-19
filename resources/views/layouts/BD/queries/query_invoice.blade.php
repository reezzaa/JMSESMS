@extends('layouts.BD.queries.transact_main')
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
              @include('layouts.BD.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.BD.sidebar')
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
            <i class="fa fa-search"> </i> Invoice Queries <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Queries</a></li>
      <li><a>Invoice</a></li>
  </ol>
<div class="block">
    <div class="table-responsive">
                            <table id="base-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                         <th class="text-center"><i class="fa fa-cube"></i><br />Invoice Number</th>
                                        <th class="text-center"><i class="fa fa-calendar"></i><br />Date Issued</th>
                                        <th class="text-center"><i class="gi gi-coins"></i><br />Amount</th>
                                        <th class="text-center"><i class="gi gi-user"></i><br />Client</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($invoices as $invoice)
                                        <tr>
                                            <td><center>{{ $invoice -> id }}</center></td>
                                            <td><center>{{ $invoice -> date }}</center></td>
                                            <td><center>{{ $invoice -> amount }}</center></td>
                                            <td><center>{{ $invoice -> clientname }} ({{ $invoice -> clientID }})</center></td>
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