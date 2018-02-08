@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax4') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);
          }
        })
    };
    readByAjax();

  function hidePrice(val)
  {
     if($('#rent').val()==0)
      {
        $('#this').remove();
        $('#remo').remove();
      }
    else
      {
        $('#here').html('<div id="this"><label for="equipprice">Rental Price per Day</label> <span class="text-danger">*</span><input type="text" id="equipprice" name="equipprice" placeholder="e.g 999999" class="form-control" maxlength="30"></div>');
         $('#addlease').html('<div id="remo"><label for="equipleaser">Equipment Leaser</label> <span class="text-danger">*</span><input type="text" id="equipleaser" name="equipleaser" placeholder="Leaser" class="form-control" maxlength="50"></div>');
      }
     
           
  }
  function editPrice(val)
  {
     if ($('#rents').val()==0)
       {
        $('#that').remove();
        $('#remos').remove();

       }
       else 
       {
        $('#there').html('<div id="that"><label for="equipprices">Rental Price per Day</label> <span class="text-danger">*</span><input type="text" id="equipprices" name="equipprices" placeholder="e.g 999999" class="form-control" maxlength="30"></div>');
        $('#editlease').html('<div id="remos"><label for="equipleasers">Equipment Leaser</label> <span class="text-danger">*</span><input type="text" id="equipleasers" name="equipleasers" placeholder="Leaser" class="form-control" maxlength="50"></div>');
       }
  }
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
            <i class="fa fa-wrench"> </i> Equipment Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a href="">Equipment</a></li>
  </ol>

  <div class="block">

  <div id="addequip_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="block">
                        <div class="block-title themed-background">
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                          </div>
                          <h3 class="themed-background" style="color:white;"><strong>Add Equipment</strong></h3>
                        </div>
                        {!! Form::open(['url'=>'equipment', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                         @include('layouts.O.mainte.equipment.form')
                      	{!! Form::close() !!}
                        <div class="clearfix"></div>
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
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Equipment">
    <i class="fa fa-plus my-float"></i></a>
@endsection

@section('script')
<script>
    $(document).ready(function(){
       var selfName = '';
        var className = '';
        var id='';
        var url = "equipment";
         $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }); 

          /////////////////////////////////////////////////////
          //clear on focus
          $('#equipname').focus(function(){
            $('span#duplicate').hide();
           });
          $('#equiptype').focus(function(){
            $('span#duplicate4').hide();
           });
           $('#equipkey').focus(function(){
            $('span#duplicatez3').hide();
           });
           $('#equipleasor').focus(function(){
            $('span#duplicate3').hide();
           });
           $('#equipprice').focus(function(){
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
            $('span#duplicate4').hide();
            $('span#duplicate3').hide();
            $('#addequip_modal').modal('show');
          });
          //////////////////////////////////////////////////////////////
         //insert data
        $('#frm-insert').on('submit', function(e){
          $('span#duplicate').hide();
          $('span#duplicate2').hide();
          $('span#duplicate3').hide();
          $('span#duplicatez3').hide();
          $('span#duplicate4').hide();
          e.preventDefault();
          if($('#equiptype').val() != null)
          {
            if($('#equipname').val().trim() != "")
            {
                  if($('#equipkey').val().trim() != "")
                  {
                    if($('#equipleaser').val().trim() != "")
                    {
                      
                  var ddata = {
                    EquipName: $('#equipname').val(),
                    EquipType: $('#equiptype').val(),
                    EquipKey: $('#equipkey').val(),
                    EquipLeaser: $('#equipleaser').val(),
                    rent: $('#rent').val(),
                    EquipPrice: $('#equipprice').val()
                  }
                  $.ajax({
                    type : 'post',
                    url  : url,
                    data : ddata,
                    dataType: 'json',
                    success:function(data){
                      readByAjax();
                      swal("Success","Equipment Added!", "success");
                      $(".modal").modal('hide');
                    },
                    error:function(data){
                       $('span#duplicatez3').text("Duplicate Equipment Key");
                       $('span#duplicatez3').show();
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
                  $('span#duplicate3').text("Fill up required");
                  $('span#duplicate3').show();
                }
                }
                else
                {
                  $('span#duplicatez3').text("Fill up required");
                  $('span#duplicatez3').show();
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
            $('span#duplicate').hide();
            $('span#duplicates').hide();
            $('span#duplicates2').hide();
            var classID = $(this).val();
            id = classID;
            $.get(url + '/' + classID + '/edit', function (data) {
                  $('#equipID').val(data.id);
                  $('#equiptypes').val(data.EquipTypeDesc);
                  $('#equipnames').val(data.EquipName);
                  $('#equipkeys').val(data.EquipKey);
                  $('#equipleasers').val(data.EquipLeaser);
                  $('#equipprices').val(data.EquipPrice);
                  $('#rents > option[value="'+ data.rent +'"]').prop('selected', true);
                  editPrice(data.rent);
                  selfName = $('#equipnames').val();
                  className = $('#equiptypes').val();
                  keys = $('#equipkeys').val();
                  leaser = $('#equipleasers').val();
                  price = $('#equipprices').val();
                  $('#edit_modal').modal('show');
              })
        });


      //update edit data
      $(this).on('submit' ,function(e){
         $('span#duplicates').hide();
         $('span#duplicates2').hide();
          e.preventDefault();
          var formData = {
                equipID: $('#equipID').val(),
                EquipName: $('#equipnames').val(),
                EquipType : $('#equiptypes').val(),
                EquipKey : $('#equipkeys').val(),
                EquipLeaser : $('#equipleasers').val(),
                EquipPrice : $('#equipprices').val(),
                rent : $('#rents').val(),

          }
          if($('#equiptypes').val() != "")
          {
            if($('#equipnames').val() != "")
            {
              if($('#equipkeys').val().trim() != "")
                  {
                    if($('#equipleasers').val().trim() != "")
                    {
                      
              if(selfName == $('#equipnames').val() && className == $('#equiptypes').val() && keys == $('#equipkeys').val() && leaser == $('#equipleasers').val() && price == $('#equipprices').val())
              {
                swal("Info", "Same Equipment Infromation", "info");
              }
              else
              {
                var mod_url = url+'/'+id;
                $.ajax({
                  type : 'put',
                  url  : mod_url,
                  data : formData,
                  dataType: 'json',
                  success:function(data){
                    readByAjax();
                    $(".modal").modal('hide');
                    swal("Success","Equipment Edited!", "success");
                  },
                  error:function(data){
                     $('span#duplicatez3').text("Duplicate Equipment Key");
                     $('span#duplicatez3').show();
                  }
                })
              }
              
                  }
                else
                {
                  $('span#duplicate3').text("Fill up required");
                  $('span#duplicate3').show();
                }
                }
                else
                {
                  $('span#duplicatez3').text("Fill up required");
                  $('span#duplicatez3').show();
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
              $('span#duplicate').text("Fill up required");
              $('span#duplicate').show();
          }
           e.stopPropagation();
        }); 

        //status listen edit
        $(this).on('change','#status',function(e){ 
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
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
        var classe = $(this).val();
        $.get(url + '/' + classe + '/edit', function (data) {
              $('#deleteID').text(data.id);
              $('#del_classname').text(data.EquipName);
              $('#del_modal').modal('show');
          })
        });

       //soft delete
       $(this).on('submit','#frm-del' ,function(e){
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