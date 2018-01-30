@extends('layouts.O.mainte.mainte_main')
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
  <div class="content-header">
      <div class="header-section">
        <h4>
            <i class="fa fa-wrench"> </i> Worker Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a href="javascript:void(0)">Worker</a></li>
      <li><a href="javascript:void(0)">Add Workers</a></li>
  </ol>

  <div class="block">
    <div class="block-title themed-background">
      <h3 class="themed-background" style="color:white;"><strong>Add Worker</strong></h3>
    </div>
    <!-- Wizard with Validation Content -->
    {!! Form::open(['url'=>'o/addworker', 'method'=>'POST', 'id'=>'form-validation', 'class' => 'form-horizontal form-bordered']) !!}
    @include('layouts.O.mainte.employee.form')
    {!! Form::close() !!}
    <div class="clearfix"></div>
    <!-- END Wizard with Validation Content -->
  </div>
@endsection
@section('script')
   <script>$(function(){ FormsValidation.init(); });</script>
   <script>
    $(document).ready(function(){
      
      $('span#duplicate').hide();
      //not working (try to hide error if user focus on the select)
      $('#example-chosen-multiple').focus(function(){
        $('span#duplicate').hide();
       });
      //
      $('#resets').on('click',function(){
       $('#example-chosen-multiple').val('').trigger('chosen:updated');
       $('#form-validation').trigger('reset');
      });
      $('#form-validation').submit(function(){
           var options = $('#example-chosen-multiple > option:selected');
           if(options.length == 0){
            $('span#duplicate').show();
            return false;
           }
           else
           {
            $('span#duplicate').hide();
           }
      });
    });
   </script>
@endsection