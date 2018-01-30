@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  function readByAjax()
    {
        $.ajax({
          type : 'get',
          url  : "{{ url('o/readByAjax8') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);
              // $('[data-toggle="tooltip"]').tooltip();
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
              @include('layouts.O.sidebar')
          <!-- Sidebar Navigation -->
          <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->
@endsection

@section('content')
@if(Session::has('flash_addemp_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Worker Added!</p>', {
      type: 'success',
      allow_dismiss: true
    });
  });
   </script>
   @elseif(Session::has('flash_addemp_failed'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Failed!</h4> <p>Duplicate Employee!</p>', {
      type: 'danger',
      allow_dismiss: true
    });
  });
   </script>
  @elseif(Session::has('flash_edit_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Success!</h4> <p>Worker Edited!</p>', {
      type: 'success',
      allow_dismiss: true
    });
  });
   </script>
   @elseif(Session::has('flash_delete_success'))
  <script>
  $(function(){
    $.bootstrapGrowl('<h4>Deleted!</h4> <p>Worker Deleted!</p>', {
      type: 'info',
      allow_dismiss: true
    });
  });
   </script>
  @endif
<div class="content-header">
    <div class="header-section">
      <h4>
          <i class="fa fa-wrench"> </i> Worker Maintenance<br>
      </h4>
    </div>
</div>
<ol class="breadcrumb breadcrumb-top">
    <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
    <li><a href="javascript:void(0)">Maintenance</a></li>
    <li><a href="javascript:void(0)">Worker</a></li>
    <li><a href="javascript:void(0)">Workers</a></li>
</ol>
  
<div class="block">
<div class="block-title themed-background">
  <h3 class="themed-background" style="color:white;"><strong>Workers</strong></h3>
</div>

<div class="table-responsive">
</div>
<i id="empID" hidden></i>
<br>
</div>
@endsection
@section('addbtn')
<a class="float" id="add" href="addworker" data-toggle="tooltip" data-placement="left" title="Add Worker">
<i class="fa fa-plus my-float"></i></a>   
@endsection
@section('script')
  <script>$(function(){ FormsValidation.init(); });</script>
  <script>
    $(document).ready(function(){
    var LName = '';var MName = '';var LName = '';var Email = '';var CNo = '';var City = '';var Prov = '';var SpecID = '';
    var id='';
    var url = "worker";
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 

      $('span#duplicate').hide();
      //not working (try to hide error if user focus on the select)
      $('#example-chosen-multiple').focus(function(){
        $('span#duplicate').hide();
       });
     /////////////////////////////////////////////////////
    //clear on focus
    $('#empspec').focus(function(){
      $('span#duplicate').hide();
     });
     $('#firstname').focus(function(){
      $('span#duplicate2').hide();
     });
     $('#midname').focus(function(){
      $('span#duplicate3').hide();
     });
     $('#lastname').focus(function(){
      $('span#duplicate4').hide();
     });
     $('#contactnum').focus(function(){
      $('span#duplicate5').hide();
     });
     $('#email').focus(function(){
      $('span#duplicate6').hide();
     });
     $('#city').focus(function(){
      $('span#duplicate7').hide();
     });
     $('#prov').focus(function(){
      $('span#duplicate8').hide();
     });


     ////////////////////////////////////////////////////////
    //reset field
    $('#add').on('click',function(){
       /////////////////start top loading//////////
        NProgress.start();
        /////////////////////////////////////////////
    });

       //////////////////////////////////////////////////////////////
       //insert data
      $('#frm-insert').on('submit', function(e){
        $('span#duplicate').hide();
        $('span#duplicate2').hide();
        $('span#duplicate3').hide();
        $('span#duplicate4').hide();
        $('span#duplicate5').hide();
        $('span#duplicate6').hide();
        $('span#duplicate7').hide();
        $('span#duplicate8').hide();
        e.preventDefault();

        if($('#empspec').val() != "")
        {
          if($('#firstname').val().trim() != "")
          {
            if($('#lastname').val().trim() != "")
            {
              if($('#contactnum').val().trim() != "" && $('#contactnum').val().length >= 11)
              {
                if($('#email').val().trim() != "")
                {
                  if($('#city').val().trim() != "")
                  {
                    if($('#prov').val().trim() != "")
                    {
                       var ddata = {
                          specss : $('#empspec').val(),
                          EmpFirstName: $('#firstname').val(),
                          EmpLastName: $('#lastname').val(),
                          EmpMiddleName: $('#midname').val(),
                          EmpEmail: $('#email').val(),
                          EmpContactNo: $('#contactnum').val(),
                          EmpCity: $('#city').val(),
                          EmpProvince: $('#prov').val(),
                        } 
                        $.ajax({
                          type : 'post',
                          url  : url,
                          data : ddata,
                          dataType: 'json',
                          success:function(data){
                            readByAjax();
                            swal("Success","Worker Added!", "success");
                            $(".modal").modal('hide');
                            window.location = 'o/worker';
                          },
                          error:function(data){
                             $('span#duplicate').text("Duplicate Worker");
                             $('span#duplicate').show();
                          }
                        })
                    }
                    else
                    {
                      $('span#duplicate8').text("Fill up required");
                      $('span#duplicate8').show();
                    }
                  }
                  else
                  {
                    $('span#duplicate7').text("Fill up required");
                    $('span#duplicate7').show();
                  }
                }
                else
                {
                  $('span#duplicate6').text("Fill up required");
                  $('span#duplicate6').show();
                }
              }
              else
              {
                $('span#duplicate5').text("Invalid Number");
                $('span#duplicate5').show();
              }
            }
            else
            {
              $('span#duplicate4').text("Fill up required");
              $('span#duplicate4').show();
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
            $('span#duplicate').text("Select Specialization");
            $('span#duplicate').show();
        }
        e.stopPropagation();
      });

      //get view data
      $(this).on('click','#view_supp', function(){
          var classID = $(this).val();
          var employID = '';
          var a,b=0;
          $('#special').empty() ;
          $('#special2').empty();
         /////////////////top loading//////////
          NProgress.start();
          /////////////////////////////////////
          $.ajax({
          type : 'get',
          url  : 'empspec'+'/'+classID+'/edit',
          dataType: 'json',
          success:function(data){
            for(a=0;a<data.length;a++)
            { 
              if(a==0)
              {
                document.getElementById("special").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';;
              }
              else if(a == (data.length)-1 && (a%2) == 0)
              {
                document.getElementById("special").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';
              }
              else if(a == (data.length)-1 && (a%2) != 0)
              {
                document.getElementById("special2").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';
              }
              else if((a%2) != 0 && b == 0)
              {
                document.getElementById("special2").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';
                b++;
              }
              else if((a%2) != 0 && b != 0)
              {
                document.getElementById("special2").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';
                b++;
              }
              else
              {
                document.getElementById("special").innerHTML += '<li>'+ data[a].SpecDesc +'</li>';
              }
            }
          }
          });
        $.get(url + '/' + classID , function (data) {
              employID = data.id;
              $('#nameheader').text(data.EmpLname+', '+data.EmpFname+' '+data.EmpMname);
              $('#specialize').text(data.SpecDesc);
              $('#address').text(data.EmpCity+', '+data.EmpProvince);
              $('#contactno').text(data.EmpContactNo);
              if(data.EmpEmail == null)
              {
                $('#email').text("None");
              }
              else
                $('#email').text(data.EmpEmail);
              $('#viewemp_modal').modal('show');
            /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
          });
          
      });

    //get edit data
      $(this).on('click','#edit_supp', function(){
         /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
          $('span#duplicate').hide()
          $('#example-chosen-multiple').val('').trigger('chosen:updated');
          var classID = $(this).val();
          id = classID;
          var o;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#empID').text(data.id);
                $('#EmpLname').val(data.EmpLname);
                $('#EmpMname').val(data.EmpMname);
                $('#EmpFname').val(data.EmpFname);
                $('#EmpEmail').val(data.EmpEmail);
                $('#EmpContactNo').val(data.EmpContactNo);
                var count = ($('#EmpContactNo').val()).length;
                if(count == 8)
                {
                  $('#contacttype > option[value="Landline"]').prop('selected', true);
                }
                else
                {
                  $('#contacttype > option[value="Phone"]').prop('selected', true);
                }
                $('#EmpCity').val(data.EmpCity);
                $('#EmpProvince').val(data.EmpProvince);
            })
          $.get(url + '/' + classID + '/editSpec', function (data) {
                for(o=0;o<data.length;o++)
                {
                  $('#example-chosen-multiple > option[value="'+ data[o].id +'"]').prop('selected', true);
                } 
                $('#example-chosen-multiple').trigger('chosen:updated');
                $('#empedit_modal').modal('show');
                 /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });
      //
      $('#resets').on('click',function(){
       $('#form-validation').trigger('reset');
      });
      //update edit data
      $('#form-validation').submit(function(e){
           var options = $('#example-chosen-multiple > option:selected');
           if(options.length == 0){
            $('span#duplicate').show();
            return false;
           }
           else
           {
            $('span#duplicate').hide();
           }
           e.preventDefault();
          var formData = {
                EmpLname: $('#EmpLname').val(),
                EmpMname: $('#EmpMname').val(),
                EmpFname: $('#EmpFname').val(),
                EmpEmail: $('#EmpEmail').val(),
                EmpContactNo: $('#EmpContactNo').val(),
                EmpCity: $('#EmpCity').val(),
                EmpProvince: $('#EmpProvince').val(),
                array: $('#example-chosen-multiple').val()
          }
         
          /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
          var mod_url = url+'/'+$('#empID').text();
          $.ajax({
            type : 'put',
            url  : mod_url,
            data : formData,
            dataType: 'json',
            success:function(data){
              $(function(){
                $.bootstrapGrowl('<h4>Success!</h4> <p>Worker Information Update!</p>', {
                  type: 'success',
                  delay: '2500',
                  allow_dismiss: true
                });
              });
              window.location.reload();
              $(".modal").modal('hide');
            },
            error:function(data){
              $(".modal").modal('hide');
              $(function(){
                $.bootstrapGrowl('<h4>Failed!</h4> <p>Duplicate Worker Information!</p>', {
                  type: 'danger',
                  allow_dismiss: true
                });
              });
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
            }
          })
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
              $('#del_classname').text(data.EmpFirstName+' '+data.EmpMiddleName+' '+data.EmpLastName);
              $('#del_modal').modal('show');
               /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
          })
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
              $.bootstrapGrowl('<h4>Success!</h4> <p>Status Changed!</p>', {
                type: 'success',
                delay: '1700',
                allow_dismiss: true
              });
              window.location.reload();
            }
        });
         e.stopPropagation();
      });


       //soft delete
       $(this).on('submit','#frm-del' ,function(e){
            e.preventDefault();
             /////////////////start top loading//////////
            NProgress.start();
            ///////////////////////////////////////////
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
                   /////////////////stop top loading//////////
                  NProgress.done();
                  ///////////////////////////////////////////
                }
              })
             e.stopPropagation();
          }); 

  });
    </script>
@endsection