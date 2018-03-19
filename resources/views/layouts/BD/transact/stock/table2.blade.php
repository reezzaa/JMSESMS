@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
  var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();

  //  function readByAjax()
  // {
    
  //     $.ajax({
  //       type : 'get',
  //       url  : '/bd/readByAjax2/'+lastPart,
  //       dataType : 'html',
  //       success:function(data)
  //       { 
  //           $('.table-responsive').html(data);
              
  //       }
  //     })
  // };
  // readByAjax();

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
        <li><a href="{{ route('stock.index')}}">Stock Adjustment</a></li>

    </ol>
       <div class="block full">
         <div class="block-title themed-background">
                            <h2 style="color:white"><strong>List of Tasks</strong></h2>
                        </div>
                        
                                <br>
                    <div class="table-responsive">
                        <table id="qclient-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
                            <thead>
                              <tr>
                                <th class="text-center">TASK</th>
                                <th style="width: 280px" class="text-center"></th>
                              </tr>
                            </thead>
                          <tbody>
                            @foreach($task as $var)
                            <tr>
                              <td class="text-center">{{$var->ServTask}}</td>
                              <td class="text-center">
                                     <a href=" {{ route('stock.show', $var->conid)}}"><button class="btn btn-alt btn-md btn-info" value="{{$var->conid}}"><span class="gi gi-new_window"> </span> Open</button></a>
                                  </td>
                              
                            </tr>
                            @endforeach
                          </tbody>
                          </table> 
                    </div>
                      
                    </div>
                    <!-- END Working Tabs Block -->
         


    

@endsection


@section('script')
<script>$(function(){ TablesDatatables.init(); });</script>

  <script >
    // $(function(){ FormsValidation.init(); });

     $(document).ready(function(){
      var id='';
      var url = "stock";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


    });
  </script>


@endsection