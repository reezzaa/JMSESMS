@extends('layouts.PM.transact.transact_main')
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
            <i class="gi gi-sort"> </i> Stock Usage Report <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Stock Usage Report</a></li>
  </ol>
   <div class="block">
    {{ Form::open(['target' => '_blank','url'=>'pm/stockusagereport/printStockUsage']) }}
               
                <div class="row">
                 
                  <div class="col-md-6 col-md-offset-2">
                    <label for="quotation">Select Date Range</label> 

                                   <div class="input-group" data-date-format="yyyy-mm-dd">
                                      <input type="date" id="from" name="from" class="form-control text-center " placeholder="From">
                                      <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                      <input type="date" id="to" name="to" class="form-control text-center " placeholder="Through">
                                  </div>
                               </div>

                    
                </div>
                <br>
              <div class="col-md-offset-9">
                 {!! Form::submit('Generate',['id'=>'submit','class'=>'btn btn-alt btn-success']) !!}
              </div>
              <div class="clearfix"></div>
              <br>
              {{ Form::close() }}

                </div>
   
@endsection


@section('script')
 <script>
   $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
     


    });

   
 </script>
@endsection