@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax5') }}",
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
              @include('layouts.O.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.O.mainte.sidebar')
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
              <i class="fa fa-wrench"> </i>Tasks Maintenance<br>
          </h4>
        </div>
    </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Maintenance</a></li>
        <li><a href="">Tasks</a></li>
    </ol>
  
       <div class="block">
          <div class="table-responsive">
            
          </div>
           
          <br>
        </div>
@endsection

@section('addbtn')
 <a href="{{ route('task.create')}}" class="float"  data-toggle="tooltip" data-placement="left" title="Add Service">
    <i class="fa fa-plus my-float"></i>
  </a>
@endsection

@section('script')
 <script>
    $(document).ready(function(){
    var selfName = '';
    var id='';
    var url = "task";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(this).on('click','.view_supp',function()
      {
        var classID = $(this).val();
          var a,b=0;

         /////////////////top loading//////////
          NProgress.start();
          /////////////////////////////////////
          $.ajax({
          type : 'get',
          url  : url+'/'+classID,
          dataType: 'json',
          success:function(data){
            for(a=0;a<1;a++)
            {
                document.getElementById("nameheader").innerHTML += '<strong>'+data[a].ServTask+'</strong>';
                $('#view_modal').modal('show');
                

            }
            // $.get('fetch', function (data) {
            // for (a=0;a<data.length;a++) 
            // {
            // //   document.getElementById("right").innerHTML += '<ol> <strong>  Price: </strong>  ₱ '+data[a].MaterialUnitPrice+'</ol>';
            // //  document.getElementById("header").innerHTML += '<ol> <strong>  Type: </strong>'+data[a].MatTypeName+'</ol><ol><strong>  Classification: </strong>'+data[a].MatClassName+'</ol><br><ol><strong>  Unit of Measurement: </strong>'+data[a].DetailUOMText+'</ol>';
            // //   document.getElementById("detail").innerHTML += ' <hr> <ol><h4><strong>Specifications</strong></h4><br> <ol> <strong>Brand: </strong>'+data[a].MaterialBrand+'</ol><ol> <strong>Size: </strong>'+data[a].MaterialSize+'</ol><ol> <strong>Color: </strong>'+data[a].MaterialColor+'</ol><ol> <strong>Dimension: </strong>'+data[a].MaterialDimension+'</ol>';
            // }
            
          }
          });

           /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
          $('#nameheader').empty();
          $('#right').empty();
          $('#header').empty();
          $('#detail').empty();
      });
       //status listen edit
      $(this).on('change','#status',function(e){ 
       /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
       e.preventDefault(); 
       var stat = $(this).val();
       $.ajax({
          url: 'task/checkbox' + '/' + stat,
          type: "PUT",
          success: function (data) {
              readByAjax();
          }
      });
       e.stopPropagation();
    });

    //delete get data
     $(this).on('click','.del_supp', function(){
      /////////////////start top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
      var classe = $(this).val();
      $.get(url + '/' + classe + '/edit', function (data) {
            $('#deleteID').text(data.id);
            $('#del_classname').text(data.ServTask);
            $('#del_modal').modal('show');
            /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
        })
      });

     //soft delete
     $(this).on('submit','#frm-del' ,function(e){
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          e.preventDefault();
            var mod_url = url+'/'+$('#deleteID').text()+ '/delete';
            var data = $('#del_classname').text();
            $.ajax({
              type : 'put',
              url  : mod_url,
              data : data,
              dataType: 'json',
              success:function(data){
                readByAjax();
                $(".modal").modal('hide');
                swal("Deleted!", "", "success");
              }
            })
           e.stopPropagation();
        }); 
      });  
     
  </script>
@endsection