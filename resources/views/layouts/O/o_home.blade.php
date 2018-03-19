@extends('layouts.O.main')
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
              @include('layouts.O.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.O.sidebar')
              <!-- END Sidebar Navigation -->
          </div>
          <!-- END Sidebar Content -->
      </div>
      <!-- END Wrapper for scrolling functionality -->
  </div>
  <!-- END Main Sidebar -->
@endsection

@section('content')
  @if(Session::has('flash_login_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p> Successfully login</p>', {
      type: 'success',
      delay: 3000,
      allow_dismiss: true
    });
  });
   </script>
  @endif
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
  <div class="content-header content-header-media">
      <div class="header-section">
          <div class="row">
              <!-- Main Title (hidden on small devices for the statistics to fit) -->
              <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                  <h1>Welcome <strong>Operations</strong><br><small></small></h1>
              </div>
              <!-- END Main Title -->

              <!-- Top Stats -->
                <!-- Nothing to fucking show -->
              <!-- END Top Stats -->
          </div>
      </div>
      <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
      <!-- <img src="img/header/dashboard2.jpg" alt="header image" class="animation-pulseSlow"> -->
  </div>
  <!-- END Dashboard Header -->         
@endsection