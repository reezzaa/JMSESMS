@extends('layouts.PM.transact.transact_main')
@section('head')
<script>

function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('pm/readByAjax30') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);
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
@if(Session::has('flash_add_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Contract Added!</p>', {
      type: 'success',
      allow_dismiss: true
    });
  });
   </script>
@endif   
  <div class="content-header">
      <div class="header-section">
        <h4>
            <i class="hi hi-list"> </i> Manage Contract <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Manage Contract</a></li>
  </ol>
    <div class="block">
      <div class="table-responsive">
      
    </div>
    <br>
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
      var id='';
      var url='contract';

      //  //get edit data
      // $(this).on('click','.edit_supp', function(){
      //     /////////////////start top loading//////////
      //     NProgress.start();
      //     ///////////////////////////////////////////
      //     $('span#duplicate').hide();
      //     var classID = $(this).val();
      //     id=classID;
      //     $('#edit_modal').modal('show');
      //     /////////////////stop top loading//////////
      //     NProgress.done();
      //     ///////////////////////////////////////////
      // });

      //update edit data
      $(this).on('submit', function(e){
        
         $('span#duplicate').hide();
          e.preventDefault();
          
          if($('#co').val() != "")
          {
              var ddata = {
                co: $('#co').val(),
                id: id
              }
              console.log(ddata);
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              $.ajax({
                type : 'post',
                url  : url,
                data : ddata,
                dataType: 'json',
                success:function(data){
                  readByAjax();
                  $(".modal").modal('hide');
                  swal("Success","Contract Order Recorded!", "success");
                },
                error:function(data){
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   $('span#duplicate').text("Duplicate Contract Order");
                   $('span#duplicate').show();
                }
              })
            
          }
          else
          {
            $('span#duplicate').text("Fill up required");
            $('span#duplicate').show();
          }
           e.stopPropagation();
        }); 


    });

   
 </script>
@endsection