@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
   function readByAjax()
  {
    /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
      $.ajax({
        type : 'get',
        url  : "{{ url('bd/readByAjax1') }}",
        dataType : 'html',
        success:function(data)
        { 
            $('#here').html(data);
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
        }
      })
  };
readByAjax();
  
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
          <i class="gi gi-sort"> </i> Billing & Collection Transaction<br>
      </h4>
    </div>
  </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('bd.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Transaction</a></li>
        <li><a href="javascript:void(0)">Billing & Collection</a></li>
    </ol>
     <div class="block-title themed-background">
        <h3 class="themed-background" style="color:white"><strong>List of Contracts</strong></h3>
        </div>
           <div class="block" id="here">
             
           </div>
        <br>
         
    

@endsection


@section('script')
  <script >
    // $(function(){ FormsValidation.init(); });
     $(document).ready(function(){
      var id='';
      var url = "billing";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
 readByAjax();
      
    });
  </script>


@endsection