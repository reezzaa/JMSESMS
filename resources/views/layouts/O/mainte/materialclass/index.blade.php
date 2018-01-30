@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax') }}",
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
            <i class="fa fa-wrench"> </i> Material Classification Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a href="javascript:void(0)">Material</a></li>
      <li><a href="javascript:void(0)">Material Classification</a></li>
  </ol>
  <div class="block">
    <!-- <div class="row">
      <div class="col-md-12">
         <button id="add" class="btn btn-lg btn-primary pull-right" data-toggle="modal" data-target=".add-matclass-modal" ><span class="gi gi-circle_plus" ></span> Add</button>
      </div>
    </div>
    <hr> -->
   
    <div id="add_modal" class="modal fade add-matclass-modal" tabindex="-1" role="dialog" aria-labelledby="AddMatClassModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Add Material Classification</strong></h3>
            </div>
              
            {!! Form::open(['url'=>'materialclass', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <label for="mattype" class="col-md-offset-4">Material Type</label> <span class="text-danger">*</span>
                    {!! Form::select('mattype', $mattype, null,  ['id'=>'mattype','class'=>'form-control', 'placeholder'=>' ']) !!}
                  </div>
                </div>
                <span id="duplicate" class="help-block animation-slideDown col-md-offset-3">
                  Duplicate Material Classification Name
                </span>
                <br>
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                      <label for="matclassname" class="col-md-offset-3"> 
                        Material Classification Name
                      <span class="text-danger">*</span> 
                      </label>
                        {!! Form::text('matclassname',null ,['id'=>'matclassname','placeholder'=>'Material Classification Name', 'class' => 'form-control', 'maxlength'=>'30'])
                        !!}
                      <span id="duplicate2" class="help-block animation-slideDown">
                            Duplicate Material Classification Name
                      </span>
                      <script>
                        $('#matclassname').alphanum({
                          allow :    '-,.()/', // Specify characters to allow
                        });
                      </script>
                    </div>
                  </div>
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
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Material Classification">
    <i class="fa fa-plus my-float"></i>
  </a>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
    var selfName = '';var typeName;
    var id='';
    var url = "materialclass";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      //hide
       $('#matclassname').focus(function(){
      $('span#duplicate').hide();
      $('span#duplicate2').hide();
     });

     $('.float').click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        $('#frm-insert').trigger("reset");
        $('span#duplicate').hide();
        $('span#duplicate2').hide();
        $('#add_modal').modal('show');
      });

      //insert data
      $('#frm-insert').on('submit', function(e){
        $('span#duplicate').hide();
        $('span#duplicate2').hide();
        e.preventDefault();

        if($('#mattype').val() != null)
        {
          if($('#matclassname').val().trim() != "")
          {
            /////////////////start top loading//////////
            NProgress.start();
            ///////////////////////////////////////////
            var ddata = {
                MatClassname: $('#matclassname').val(),
                MatTypeID: $('#mattype').val()
            }
            $.ajax({
              type : 'post',
              url  : url,
              data : ddata,
              dataType: 'json',
              success:function(data){
                readByAjax();
                $(".modal").modal('hide');
                swal("Success","Material Classification Added!", "success");
              },
              error:function(data){
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                 $('span#duplicate2').text("Duplicate Material Classification");
                 $('span#duplicate2').show();
              }
            })
          }
          else
          {
            $('span#duplicate2').text("Fill up required");
            $('span#duplicate2').show();
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
          $('span#duplicates').hide();
          $('span#duplicates2').hide();
          var classID = $(this).val();
          id = classID;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#matclassID').val(data.id);
                $('#MaterialClassname').val(data.MatClassName);
                $('#mattypes > option[value="'+ data.MatTypeID +'"]').prop('selected', true);
                typeName = data.MatTypeID;
                selfName = $('#MaterialClassname').val();
                $('#edit_modal').modal('show');
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });

      //update edit data
      $(this).on('submit', function(e){
         $('span#duplicate').hide();
         $('span#duplicate2').hide();
          e.preventDefault();
          if($('#mattypes').val() != "")
          {
            if($('#MaterialClassname').val() != "")
            {
              if(selfName == $('#MaterialClassname').val() && typeName == $('#mattypes').val())
              {
                swal("Info", "Same Material Classname", "info");
              }
              else
              {
                var formData = {
                  id: $('#matclassID').val(),
                  MatClassname: $('#MaterialClassname').val(),
                  MatTypeID: $('#mattypes').val()
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
                    swal("Success","Material Classification Edited!", "success");
                  },
                  error:function(data){
                    /////////////////stop top loading//////////
                  NProgress.done();
                  ///////////////////////////////////////////
                     $('span#duplicates2').text("Duplicate Material Classification Name");
                     $('span#duplicates2').show();
                  }
                })
              }
            }
            else
            {
              $('span#duplicates2').text("Fill up required");
              $('span#duplicates2').show();
            }
          }
          else
          {
              $('span#duplicates').text("Select Equipment Type");
              $('span#duplicates').show();
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
          url: 'materialclass/checkbox' + '/' + stat,
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
            $('#del_classname').text(data.MatClassName);
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