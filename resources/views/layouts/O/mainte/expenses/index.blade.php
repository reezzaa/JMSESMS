@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax18') }}",
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
            <i class="fa fa-wrench"> </i> Expenses Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a>Expenses</a></li>
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
              <h3 class="themed-background" style="color:white;"><strong>Add Expenses</strong></h3>
            </div>
              
            {!! Form::open(['url'=>'expenses', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                <div class="form-group">
                <label for="exdesc" > 
                  Expenses Description
                <span class="text-danger">*</span> 
                </label>
                {!! Form::text('exdesc',null ,['id'=>'exdesc','placeholder'=>'Expenses Description', 'class' => 'form-control', 'maxlength'=>'30'])
                !!}
                <span id="duplicate" class="help-block animation-slideDown">
                      Duplicate Material Classification Name
                </span>
                <script>
                  $('#exdesc').alphanum({
                    allow :    '-,.()/', // Specify characters to allow
                  });
                </script>
                </div>
                <div class="form-group">
                <label for="exvalue" > 
                  Amount
                <span class="text-danger">*</span> 
                </label>
                {!! Form::text('exvalue',null ,['id'=>'exvalue','placeholder'=>'Amount', 'class' => 'form-control', 'maxlength'=>'30'])
                !!}
                <span id="duplicate1" class="help-block animation-slideDown">
                      Duplicate Material Classification Name
                </span>
               <script>
                 $('#exvalue').numeric({
                   decimalSeparator: ".",
                    maxDecimalPlaces : 2,
                    allowMinus:   false
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
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Expenses">
    <i class="fa fa-plus my-float"></i>
  </a>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
    var selfName = '';
    var amounts = '';
    var id='';
    var url = "expenses";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      //hide
       $('#exdesc').focus(function(){
      $('span#duplicate').hide();
     });
       $('#exvalue').focus(function(){
      $('span#duplicate1').hide();
     });

     $('.float').click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        $('#frm-insert').trigger("reset");
        $('span#duplicate').hide();
        $('span#duplicate1').hide();
        $('#add_modal').modal('show');
      });

      //insert data
      $('#frm-insert').on('submit', function(e){
        $('span#duplicate').hide();
        $('span#duplicate1').hide();
        e.preventDefault();
        if($('#exdesc').val().trim() != "")
          {
            if($('#exvalue').val().trim() != "")
          {
            /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
            var ddata = {
                Desc: $('#exdesc').val(),
                Value: $('#exvalue').val()
            }
            $.ajax({
              type : 'post',
              url  : url,
              data : ddata,
              dataType: 'json',
              success:function(data){
                readByAjax();
                $(".modal").modal('hide');
                swal("Success","Expense Added!", "success");
              },
              error:function(data){
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                 $('span#duplicate').text("Duplicate Expenses Description");
                 $('span#duplicate').show();
              }
            })
          }
          else
          {
            $('span#duplicate1').text("Fill up required");
            $('span#duplicate1').show();
          }
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
          $('span#duplicate1').hide();
          var classID = $(this).val();
          id = classID;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#exdescs').val(data.MiscDesc);
                $('#exvalues').val(data.MiscValue);
                selfName =   $('#exdescs').val();
                amounts =   $('#exvalues').val();
                $('#edit_modal').modal('show');
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });

      //update edit data
      $(this).on('submit', function(e){
        
         $('span#duplicate').hide();
         $('span#duplicate1').hide();
          e.preventDefault();
          
          if($('#exdescs').val() != "")
          {
            if($('#exvalues').val() != "")
             {
            if(selfName == $('#exdescs').val() && amounts == $('#exvalues'))
            {
              swal("Info", "Same Expense Information", "info");
            }
            else
            {
              var formData = {
                Desc: $('#exdescs').val(),
                Value: $('#exvalues').val()
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
                  swal("Success","Expense Edited!", "success");
                },
                error:function(data){
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   $('span#duplicate').text("Duplicate Expense Description");
                   $('span#duplicate').show();
                }
              })
            }
            }
          else
          {
            $('span#duplicate1').text("Fill up required");
            $('span#duplicate1').show();
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
          url: 'expenses/checkbox' + '/' + stat,
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
            $('#del_classname').text(data.MiscDesc);
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