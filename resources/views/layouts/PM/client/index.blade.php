@extends('layouts.PM.main')
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
            <i class="fa fa-user"> </i> Client<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Client</a></li>
  </ol>
   <div class="block-title themed-background">
        <h3 class="themed-background" style="color:white"><strong>List of Clients</strong></h3>
        </div>
      <div class="block">
          @include('layouts.PM.client.table')
          <br>
      </div>
 
   
@endsection

@section('addbtn')
<a href=" {{route('client.create')}}" class="float" data-toggle="tooltip" data-placement="left" title="Add Client">
    <i class="fa fa-plus my-float"></i>
  </a>
@endsection

@section('script')
 
@endsection