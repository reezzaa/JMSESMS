@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax11') }}",
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
              <i class="fa fa-wrench"> </i> Detail Unit of Measurement Maintenance<br>
          </h4>
        </div>
    </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Maintenance</a></li>
        <li><a href="javascript:void(0)">Unit of Measurement</a></li>
        <li><a href="">Detail</a></li>
    </ol>
    <div class="block">
      <div id="adduom_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="block">
                      <div class="block-title themed-background">
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                        </div>
                        <h3 class="themed-background" style="color:white;"><strong>Add Detail Unit of Measurement</strong></h3>
                      </div>

                      {!! Form::open(['url'=>'detailuomeasure', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                       <div class="form-group">
                          <label for="groupuomname">Dimension</label>
                          {!! Form::select('groupuomname', $groupuom, null,  ['id'=>'groupuomname','class'=>'form-control', 'placeholder'=>' ']) !!}
                         <span id="duplicate" class="help-block animation-slideDown">
                          Duplicate Material Name
                          </span>
                        </div>
                      <div class="form-group">
                        <label for="detailuomname">Detail UOM Name </label>
                        {!! Form::text('detailuomname',null ,['id'=>'detailuomname','placeholder'=>'Detail UOM Name', 'class' => 'form-control', 'maxlength'=>'30']) !!}
                        <span id="duplicate2" class="help-block animation-slideDown">
                          Duplicate Material Name
                        </span>
                        <script>
                          $('#detailuomname').alphanum({
                                  allow :    '-,.()/', // Specify characters to allow
                                });
                        </script>
                      </div>
                      <div class="form-group">
                        <label for="uomsymbol">UOM Symbol</label>
                        {!! Form::text('uomsymbol',null ,['id'=>'uomsymbol','placeholder'=>'UOM Symbol', 'class' => 'form-control']) !!}
                        <span id="duplicate3" class="help-block animation-slideDown">
                          Duplicate Material Name
                          </span>
                      </div>
                      <div class="pull-right">
                        <button id="cancel" type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                        <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add</button>
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
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Detailed UOM">
  <i class="fa fa-plus my-float"></i></a>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
       var selfName = '';
       var selfPrice = '';
        var className = '';
        var id='';
        var url = "detailuomeasure";
         $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }); 

          /////////////////////////////////////////////////////
          //clear on focus
          $('#equiptype').focus(function(){
            $('span#duplicate').hide();
           });
           $('#equipname').focus(function(){
            $('span#duplicate2').hide();
           });
           $('#price').focus(function(){
            $('span#duplicate3').hide();
           });
           
           ////////////////////////////////////////////////////////
          //reset field
          $('.float').click(function(){
            $('html,body').animate({
                scrollTop: 0
            }, 500);
            $('#frm-insert').trigger("reset");
            $('span#duplicate').hide();
            $('span#duplicate2').hide();
            $('span#duplicate3').hide();
            $('#adduom_modal').modal('show');
          });
          //////////////////////////////////////////////////////////////
         //insert data
        $('#frm-insert').on('submit', function(e){
          $('span#duplicate').hide();
          $('span#duplicate2').hide();
          $('span#duplicate3').hide();
          e.preventDefault();
          if($('#groupuomname').val() != null)
          {
            if($('#detailuomname').val().trim() != "")
            {
              if($('#uomsymbol').val().trim() != "")
              {
                var ddata = {
                  GroupUOMID: $('#groupuomname').val(),
                  DetailUOMText: $('#detailuomname').val(),
                  UOMUnitSymbol: $('#uomsymbol').val()
                }
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
                    swal("Success","Detailed UOM Added!", "success");
                  },
                  error:function(data){
                    /////////////////stop top loading//////////
                    NProgress.done();
                    ///////////////////////////////////////////
                     $('span#duplicate2').text("Duplicate Detailed UOM Name");
                     $('span#duplicate2').show();
                  }
                })
              }
              else
              {
                $('span#duplicate3').text("Fill up required");
                $('span#duplicate3').show();
              }
            }
            else
            {
              $('span#duplicate2').text("Fill up required");
              $('span#duplicate2').show();
            }
          }
          else
          {
              $('span#duplicate').text("Select Based UOM");
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
            $('span#duplicates3').hide();
            var classID = $(this).val();
            id = classID;
            $.get(url + '/' + classID + '/edit', function (data) {
                  $('#detailuomID').val(data.id);
                  $('#uomsymbols').val(data.UOMUnitSymbol);
                  $('#detailuomnames').val(data.DetailUOMText);
                  $('#groupuomnames > option[value="'+ data.GroupUOMID +'"]').prop('selected', true);
                  selfName = $('#detailuomname').val();
                  selfPrice = $('#uomsymbol').val();
                  className = $('#groupuomname').val();
                  $('#edit_modal').modal('show');
                  /////////////////stop top loading//////////
                  NProgress.done();
                  ///////////////////////////////////////////
              })
        });


      //update edit data
      $(this).on('submit' ,function(e){
         $('span#duplicates').hide();
         $('span#duplicates2').hide();
         $('span#duplicates3').hide();
          e.preventDefault();
          if($('#groupuomnames').val() != "")
          {
            if($('#detailuomnames').val() != "")
            {
              if($('#uomsymbols').val() != "")
              {
                 if(selfName == $('#detailuomnames').val() && className == $('#groupuomnames').val() && selfPrice == $('#uomsymbols').val())
                {
                  swal("Info", "Same Detail UOM", "info");
                }
                else
                {
                  var formData = {
                  id: $('#detailuomID').val(),
                  DetailUOMText: $('#detailuomnames').val(),
                  GroupUOMID : $('#groupuomnames').val(),
                  UOMUnitSymbol : $('#uomsymbols').val()
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
                      swal("Success","Detailed UOM Edited!", "success");
                    },
                    error:function(data){
                    /////////////////stop top loading//////////
                    NProgress.done();
                    ///////////////////////////////////////////
                       $('span#duplicates2').text("Duplicate Detailed UOM Name");
                       $('span#duplicates2').show();
                    }
                  })
                }
              }
              else
              {
                $('span#duplicates3').text("Fill up required");
                $('span#duplicates3').show();
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
              $('span#duplicates').text("Select Detail Name");
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
            url: url + '/checkbox/' + stat,
            type: "PUT",
            success: function (data) {
                //reload
                //location.reload();
                //noreload but glitch
                readByAjax();
            }
        });
         e.stopPropagation();
      });

         //delete get data
       $(this).on('click','#del_supp', function(){
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        var classe = $(this).val();
        $.get(url + '/' + classe + '/edit', function (data) {
              $('#deleteID').text(data.id);
              $('#del_classname').text(data.DetailUOMText);
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
              console.log(mod_url);
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