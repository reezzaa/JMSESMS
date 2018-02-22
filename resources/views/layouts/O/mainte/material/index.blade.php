@extends('layouts.O.mainte.mainte_main')
@section('head')
  <script>
    function readByAjax()
      {
          $.ajax({
            type : 'get',
            url  : "{{ url('o/readByAjax2') }}",
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
      function changeType(val)
      {
        $('#matclass').empty();
        // $('#matclasse').empty();

        var id;
        var opt;
        var a;
        var newSelect = document.getElementById("matclass");
        /////////////////start top loading//////////
        NProgress.start();
        $('span#duplicate').hide();
        ///////////////////////////////////////////
        $.get('getMatClass/' + val, function (data) {
          for(a=0;a<data.length;a++)
          {
            opt = new Option(data[a].MatClassName,data[a].id);
            newSelect.appendChild(opt);
            id = data[0].id;
          }
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
        })
      }
     
      function changeUOM(val)
      {
          /////////////////start top loading//////////
          NProgress.start();
          $('span#duplicate4').hide();
          ///////////////////////////////////////////
          $('#detailuom').empty();
          var id2;
          var opt3;
          var a3;
          var newSelect3 = document.getElementById("detailuom");
          $.get('getMatUOM/' + val, function (data) {
          if(data.length != 0)
          {
            for(a3=0;a3<data.length;a3++)
            {
              opt3 = new Option(data[a3].DetailUOMText,data[a3].id);
              newSelect3.appendChild(opt3);
              id2 = data[0].id;
            }
          }
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          changeSymbol(id2);
        })
      }
      function changeSymbol(val)
      {
          /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
          $('#symbol').val('');
          $('#symbols').val('');

          var a4;
          $.get('getMatSymbol/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#symbol').val(data[a4].UOMUnitSymbol);
              $('#symbols').val(data[a4].UOMUnitSymbol);

            }
          }
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
        })
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
            <i class="fa fa-wrench"> </i> Material Maintenance<br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a href="javascript:void(0)">Maintenance</a></li>
      <li><a href="javascript:void(0)">Material</a></li>
      <li><a href="javascript:void(0)">Materials</a></li>
  </ol>

  <div class="block">
    <div id="addMat_modal" class="modal fade add-mat-modal" tabindex="-1" role="dialog" aria-labelledby="AddMatModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block">
              <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Add Material</strong></h3>
              </div>

              {!! Form::open(['url'=>'material', 'method'=>'POST', 'id'=>'frm-insert']) !!}
              @include('layouts.O.mainte.material.form')
              {!! Form::close() !!}
              <div class="clearfix"></div>
           </div>
        </div>
      </div>
    </div>

    <div class="table-responsive">
    </div><br>
  </div>
@endsection

@section('addbtn')
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Material">
<i class="fa fa-plus my-float"></i></a>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
    var selfName = '';
    var className = '';
    var selfprice = '';
    var selfuom='';
    var suppp='';
    var id='';
    var date = new Date();
    var url = "material";
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 
     /////////////////////////////////////////////////////
    //clear on focus
    $('#mattype').focus(function(){
      $('span#duplicate').hide();
     });
     $('#matclass').focus(function(){
      $('span#duplicate2').hide();
     });
     $('#matname').focus(function(){
      $('span#duplicate3').hide();
     });
      $('#matprice').focus(function(){
      $('span#duplicate4').hide();
     });
      $('#groupuom').focus(function(){
      $('span#duplicate5').hide();
     });
      $('#detailuom').focus(function(){
      $('span#duplicate6').hide();
     });


     ////////////////////////////////////////////////////////
    $('.float').click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 500);
        $('#frm-insert').trigger("reset");
        $('.select-chosen').val('').trigger('chosen:updated');
        $('#matclass').empty();
        $('span#duplicate').hide();
        $('span#duplicate2').hide();
        $('span#duplicate3').hide();
        $('span#duplicate4').hide();
        $('span#duplicate5').hide();
        $('span#duplicate6').hide();
        $('span#duplicates').hide();
        $('#addMat_modal').modal('show');
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
        $('span#duplicates').hide();
        e.preventDefault();
        if($('#mattype').val() != "")
        {
          if($('#matclass').val() != "")
          {
            if($('#matname').val().trim() != "")
            {
              if($('#matprice').val() != "")
              {
                if($('#groupuom').val() != "")
                {
                  if($('#detailuom').val() != "")
                  {
                    if($('#supplier').val() != "")
                  {
                    /////////////////start top loading//////////
                    NProgress.start();
                    ///////////////////////////////////////////
                    var ddata = {
                      MatClassID: $('#matclass').val(),
                      MaterialName: $('#matname').val(),
                      MatUOM: $('#detailuom').val(),
                      MaterialBrand: $('#matbrand').val(),
                      MaterialSize: $('#matsize').val(),
                      MaterialColor: $('#matcolor').val(),
                      MaterialDimension: $('#matdimen').val(),
                      SuppID: $('#supplier').val(),
                      MaterialUnitPrice: $('#matprice').val()
                    }
                    console.log(ddata);
                    $.ajax({
                      type : 'post',
                      url  : url,
                      data : ddata,
                      dataType: 'json',
                      success:function(data){
                        readByAjax();
                        $(".modal").modal('hide');
                        swal("Success","Material Added!", "success");
                      },
                      error:function(data){
                        /////////////////stop top loading//////////
                        NProgress.done();
                        ///////////////////////////////////////////
                         $('span#duplicate2').text("Duplicate Material Name");
                         $('span#duplicate2').show();
                      }
                    })
                    }
                  else
                  {
                    $('span#duplicates').text("Fill up required");
                    $('span#duplicates').show();
                  }
                  }
                  else
                  {
                    $('span#duplicate5').text("Fill up required");
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
            $('span#duplicate2').text("Choose Material Classification with Material Name");
            $('span#duplicate2').show();
          }
        }
        else
        {
            $('span#duplicate').text("Select Material Classification");
            $('span#duplicate').show();
        }
        e.stopPropagation();
      });
    
        
      //get edit data
      $(this).on('click','.edit_supp', function(){
          //for Matclassification and uom edit
      var newSelectm = document.getElementById("matclasse");
          $('#matclasse').empty();
          var option='';
          var i='';
      var newSelectg = document.getElementById("detailuoms");
          $('#detailuoms').empty();
          var option2='';
          var i2='';
          $('span#duplicates').hide();
          $('span#duplicates2').hide();
          $('span#duplicates3').hide();
          $('span#duplicates4').hide();
          $('span#duplicates5').hide();
          $('span#duplicates6').hide();
          var classID = $(this).val();
          id = classID;
          
          $.get(url + '/' + classID + '/edit', function (data) {
            for(a=0;a<data.length;a++)
              {
                $.get('getMatClass/'+data[a].mattypeID,function(data){
                    for (i = 0; i<data.length; i++) {
                       option = new Option(data[i].MatClassName,data[i].id);
                        newSelectm.appendChild(option);
                    }
                  })   
                  $.get('getMatUOM/'+data[a].groupID,function(data){
                    for (i2 = 0; i2<data.length; i2++) {
                       option2 = new Option(data[i2].DetailUOMText,data[i2].id);
                        newSelectg.appendChild(option2);
                    }
                  })    
                $('#matnames').val(data[a].MaterialName);
                $('#mattypes > option[value="'+ data[a].mattypeID +'"]').prop('selected', true);
                $('#matclasse > option[value="'+ data[a].MatClassID +'"]').prop('selected', true);
                $('#groupuoms > option[value="'+ data[a].groupID +'"]').prop('selected', true);
                $('#detailuoms > option[value="'+ data[a].MatUOM +'"]').prop('selected', true);  
                $('#suppliers > option[value="'+ data[a].SuppID +'"]').prop('selected', true);
                $('#matbrands').val(data[a].MaterialBrand);
                $('#matsizes').val(data[a].MaterialSize);
                $('#matcolors').val(data[a].MaterialColor);
                $('#matdimens').val(data[a].MaterialDimension);
                $('#matprices').val(data[a].MaterialUnitPrice);
                $('#matID').val(data[a].matID);
                $('#date').val(data[a].date);
                selfName=$('#matnames').val();
                className=$('#matclasse').val();
                selfPrice=$('#matprices').val();
                selfuom=$('#detailuoms').val();
                suppp=$('#suppliers').val();
                changeSymbol(data[a].MatUOM);
                // alert(className);

                  }
           
                $('#edit_modal').modal('show');
            })
      });

      //update edit data
      $(this).on('submit' ,function(e){
         $('span#duplicates').hide();
         $('span#duplicates2').hide();
         $('span#duplicates3').hide();
          e.preventDefault();
          var formData = {
                id: $('#matID').val(),
                MaterialName: $('#matnames').val(),
                MatClassID : $('#matclasse').val(),
                MatUOM: $('#detailuoms').val(),
                MaterialBrand: $('#matbrands').val(),
                MaterialSize: $('#matsizes').val(),
                MaterialColor: $('#matcolors').val(),
                MaterialDimension: $('#matdimens').val(),
                MaterialUnitPrice: $('#matprices').val(),
                SuppID: $('#suppliers').val(),
                date: $('#date').val()
          }
                if(selfName == $('#matnames').val() && className == $('#matclasse').val() && selfPrice == $('#prices').val() && selfuom == $('#detailuoms').val()&& suppp == $('#suppliers').val())
                {
                  swal("Info", "Same Required Material Information", "info");
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
                      swal("Success","Material Edited!", "success");
                    },
                    error:function(data){
                       $('span#duplicates2').text("Duplicate Material Name");
                       $('span#duplicates2').show();
                    }
                  })
                }
              
           e.stopPropagation();
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
          url  : url+'/'+classID+ '/edit',
          dataType: 'json',
          success:function(data){
            for(a=0;a<1;a++)
            {
                document.getElementById("nameheader").innerHTML += '<strong>'+data[a].MaterialName+'</strong>';
                $('#view_modal').modal('show');
                

            }
            for (a=0;a<data.length;a++) 
            {
              document.getElementById("right").innerHTML += '<ol> <strong>  Price: </strong>  ₱ '+data[a].MaterialUnitPrice+'</ol><br><ol> <strong>  Supplier: </strong>  '+data[a].SuppDesc+'</ol>';
             document.getElementById("header").innerHTML += '<ol> <strong>  Type: </strong>'+data[a].MatTypeName+'</ol><ol><strong>  Classification: </strong>'+data[a].MatClassName+'</ol><br><ol><strong>  Unit of Measurement: </strong>'+data[a].DetailUOMText+'</ol>';
              document.getElementById("detail").innerHTML += ' <hr> <ol><h4><strong>Specifications</strong></h4><br> <ol> <strong>Brand: </strong>'+data[a].MaterialBrand+'</ol><ol> <strong>Size: </strong>'+data[a].MaterialSize+'</ol><ol> <strong>Color: </strong>'+data[a].MaterialColor+'</ol><ol> <strong>Dimension: </strong>'+data[a].MaterialDimension+'</ol>';
            };
             
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
            $('#del_classname').text(data.MaterialName);
            $('#del_modal').modal('show');
        })
      });

     //soft delete
     $(this).on('submit','#frm-del' ,function(e){
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
     $(this).on('click','.show_supp',function(){
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
                document.getElementById("name").innerHTML += '<strong>'+data[a].MaterialName+'</strong>';
                $('#show_stock_modal').modal('show');

            }
             for(a=0;a<data.length;a++)
            {
                document.getElementById("area").innerHTML += '<tr><td>'+data[a].date+'</td><td> ₱ '+data[a].up_mat+'</td></tr>';
              
            }
          }
          });

           /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
          $('#name').empty();
          $('#area').empty();

          });
  });
  </script>
@endsection