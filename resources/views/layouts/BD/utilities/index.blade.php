@extends('layouts.BD.utilities.main')
@section('head')
<script>
  function companyinfo()
    {
          /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bd.utilities.companyinfo') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);
              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Company Information</strong>');
          }
        })
        /////////////////stop top loading//////////
        NProgress.done();
        ///////////////////////////////////////////
    };

  function smartcounter()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bd.utilities.smartcounter') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Smart Counter</strong> Values');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
    function showrate()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdrate.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Rate</strong>  <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
    // function showmisc()
    // {
    //   /////////////////stop top loading//////////
    //   NProgress.start();
    //   ///////////////////////////////////////////
    //     $.ajax({
    //       type : 'get',
    //       url  : "{{ route('bdmisc.index') }}",
    //       dataType : 'html',
    //       success:function(data)
    //       {
    //           $('.table-responsive').html(data);

    //           // $('[data-toggle="tooltip"]').tooltip();
    //           $('#title').html('<strong>Miscellaneous Fee</strong>  <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
    //       }
    //     })
    //      /////////////////stop top loading//////////
    //       NProgress.done();
    //      ///////////////////////////////////////////
    // };
    function showfee()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdfee.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Additional Fee</strong>  <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
    
    function showtax()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdtax.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>VAT</strong>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
  function showret()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdretention.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Retention</strong> <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
    function showrec()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdrecoupment.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Recoupment</strong> <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
    function showpaymentmode()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdpaymentmode.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Mode of Payment</strong> <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
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
  @if(Session::has('flash_add_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Company Information Added!</p>', {
      type: 'success',
      allow_dismiss: true
    });
    companyinfo();
  });
   </script>
  @elseif(Session::has('flash_edit_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Company Information Edited!</p>', {
      type: 'success',
      allow_dismiss: true
    });
    companyinfo();

  });
   </script>
    @elseif(Session::has('flash_emp_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Employee Smart Counter Added!</p>', {
      type: 'success',
      allow_dismiss: true
    });
    smartcounter();
    
  });
   </script>
       @elseif(Session::has('flash_client_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Client Smart Counter Added!</p>', {
      type: 'success',
      allow_dismiss: true
    });
    smartcounter();
    
  });
   </script>
  @endif
  <div class="content-header">
      <div class="header-section">
        <h4>
            <i class="fa fa-cogs"> </i> Manage Utilities<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('bd.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Utilities</a></li>
  </ol>
  <div class="row">
    <div class="col-md-3">
      <div class="block">
           <div class="block-title themed-background">
            <h3 class="themed-background" style="color:white"><strong>System Utilities</strong></h3>
            </div> 
              <ul class="nav nav-pills nav-stacked">
              <li>
                <a type="button" onclick="companyinfo()"><strong>Company Information</strong></a>
              </li>
              <li>
                <a  type="button" onclick="smartcounter()"><strong>Smart Counter Values</strong></a>
              </li>
              <li>
                <a  type="button" onclick="showrate()"><strong>Rate</strong></a>
              </li>
              <!-- <li>
                <a type="button" onclick="showmisc()"><strong>Miscellaneous Fee</strong></a>
              </li> -->
              <li>
                <a type="button" onclick="showfee()"><strong>Additional Fee</strong></a>
              </li>
              <li>
                <a type="button" onclick="showpaymentmode()"><strong>Mode of Payment</strong></a>
              </li>
              
              <li>
                <a type="button" onclick="showtax()"><strong>VAT</strong></a>
              </li>
              <li>
                <a type="button" onclick="showret()"><strong>Retention</strong></a>
              </li>
              <li>
                <a type="button" onclick="showrec()"><strong>Recoupment</strong></a>
              </li>
            </ul>
            <br>
       </div>
    </div>
    <div class="col-md-9">
    <div class="block ">
      <div class="block-title themed-background">
          <h3 class="themed-background" id="title" style="color:white;"></h3>
      </div>
        <div class="table-responsive">
          
        </div>

      </div>
  </div>
  </div>
  
  
@endsection

@section('script')
  <script>
   companyinfo();
  </script>
@endsection