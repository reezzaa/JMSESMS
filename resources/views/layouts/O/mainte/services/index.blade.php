@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax20') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);
              $('[data-toggle="tooltip"]').tooltip();
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
            <i class="fa fa-wrench"> </i> Services Offered Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a>Services Offered</a></li>
  </ol>
  <div class="block">
    <div id="add_modal" class="modal fade add-matclass-modal" tabindex="-1" role="dialog" aria-labelledby="AddMatClassModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Add Service </strong></h3>
            </div>
              
            {!! Form::open(['url'=>'serviceOff', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                <div class="form-group">
                <label for="servname" > 
                  Service Name
                <span class="text-danger">*</span> 
                </label>
                {!! Form::text('servname',null ,['id'=>'servname','placeholder'=>'Service Name', 'class' => 'form-control', 'maxlength'=>'30'])
                !!}
                <span id="duplicate" class="help-block animation-slideDown">
                      Duplicate Material Classification Name
                </span>
                <script>
                  $('#servname').alphanum({
                    allow :    '-,.()/', // Specify characters to allow
                  });
                </script>
                </div>
              <div class="pull-right">
                <button id="cancel" type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add
                </button>
              </div>
              <div class="clearfix"></div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive">
    </div>
    <br>
  </div>
@endsection

@section('addbtn')
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Service">
    <i class="fa fa-plus my-float"></i>
  </a>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
    var selfName = '';
    var id='';
    var url = "serviceOff";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      //hide
       $('#servname').focus(function(){
      $('span#duplicate').hide();
     });

     $('.float').click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        $('#frm-insert').trigger("reset");
        $('span#duplicate').hide();
        $('#add_modal').modal('show');
      });

      //insert data
      $('#frm-insert').on('submit', function(e){
        $('span#duplicate').hide();
        e.preventDefault();
        if($('#servname').val().trim() != "")
          {
            /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
            var ddata = {
                ServiceOffName: $('#servname').val()
            }
            $.ajax({
              type : 'post',
              url  : url,
              data : ddata,
              dataType: 'json',
              success:function(data){
                readByAjax();
                $(".modal").modal('hide');
                swal("Success","Services Offered Added!", "success");
              },
              error:function(data){
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                 $('span#duplicate').text("Duplicate Service Name");
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

      //get edit data
      $(this).on('click','.edit_supp', function(){
          /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
          $('span#duplicate').hide();
          var classID = $(this).val();
          id = classID;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#servnames').val(data.ServiceOffName);
                selfName =   $('#servnames').val();
                $('#edit_modal').modal('show');
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });

      //update edit data
      $(this).on('submit', function(e){
        
         $('span#duplicate').hide();
          e.preventDefault();
          
          if($('#servnames').val() != "")
          {
            if(selfName == $('#servnames').val())
            {
              swal("Info", "Same Service Offered Name", "info");
            }
            else
            {
              var formData = {
                ServiceOffName: $('#servnames').val()
              }
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = url+'/'+id; 
              $.ajax({
                type : 'put',
                url  : mod_url,
                data : formData,
                dataType: 'json',
                success:function(data){
                  readByAjax();
                  $(".modal").modal('hide');
                  swal("Success","Service Offered Edited!", "success");
                },
                error:function(data){
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   $('span#duplicate').text("Duplicate Service Offered Name");
                   $('span#duplicate').show();
                }
              })
            }
          }
          else
          {
            $('span#duplicate').text("Fill up required");
            $('span#duplicate').show();
          }
           e.stopPropagation();
        }); 

      //status listen edit
      $(this).on('change','#status',function(e){ 
       /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
       e.preventDefault(); 
       var stat = $(this).val();
       $.ajax({
          url: 'serviceOff/checkbox' + '/' + stat,
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
            $('#del_classname').text(data.ServiceOffName);
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