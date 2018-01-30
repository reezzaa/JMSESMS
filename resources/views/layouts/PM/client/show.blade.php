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
  @foreach($client as $client)
      <div class="block full">
          <div class="block-title themed-background">
            <div class="block-options pull-right">
                <a href="{{$client->strCompClientID}}/edit" class="btn btn-sm btn-alt btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-alt btn-primary" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>
            </div>
          <h3 class="themed-background" style="color:white;"><strong>{{ $client->strCompClientName }}</strong></h3>
          </div>
           <div class="block-section">
              <!-- Company Info -->
                  <div class="col-md-offset-5">
                    <a href="{{url('images', $client->strCompClientImage)}}" data-toggle="lightbox-image">
                      <img src="{{url('images', $client->strCompClientImage)}}" alt="company_logo" style="width:145px;">
                    </a>
                  </div><hr>
                  <div class="col-md-offset-8">
                    <h5><strong>Registered TIN:</strong> {{ $client->strCompClientTIN }}</h5>
                  </div>
                  <div class="col-md-offset-1">
                    <h5><strong>Representative:</strong> {{ $client->strCompClientRepresentative }}</h5>
                    <h5><strong>Position:</strong> {{ $client->strCompClientPosition }}</h5>
                  </div>
                  <div class="col-md-offset-1">
                    <address>
                        <strong>Address:</strong> {{ $client->strCompClientAddress }} {{ $client->strCompClientCity }}, {{ $client->strCompClientProv }}<br>
                        <br>
                        <i class="fa fa-phone"></i> {{ $client->strCompClientContactNo }}<br>
                        <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{ $client->strCompClientEmail }}</a>
                    </address>
                  </div>
            </div>
            @endforeach
            <hr>
            <div class="block">
            <div class="block-title">
              <h3><strong>Contracts</strong></h3>
            </div>
           <div class="block-section">
              <!-- Contract List -->
                  <div class="table-responsive">
                    @include('layouts.PM.client.contract')
                  </div>
            </div>
          </div>
        </div>
 
   
@endsection

@section('script')
 
@endsection