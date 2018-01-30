@extends('layouts.PM.utilities.main')
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
      <div class="block">
        <div class="block-title themed-background">
        <h3 class="themed-background" style="color:white"><strong>Edit {{ $client->strClientName }}</strong></h3>
        </div>
          {!! Form::model($client, ['method'=>'PATCH', 'action'=>['PM\ClientController@update', $client->strCompClientID], 'id'=>'save-client','class'=>'form-horizontal form-bordered', 'files' => true]) !!}
            @include('layouts.PM.client.editform')
            <div class="form-group">
              <div class="col-md-offset-11">
                {!! Form::submit('Edit',['class'=>'btn btn-alt btn-success']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
 
   
@endsection

@section('script')
 <script type="text/javascript">
  $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#strClientImage").change(function(){
        readURL(this);
    });   
  });
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection