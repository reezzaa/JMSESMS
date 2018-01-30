@extends('layouts.O.mainte.mainte_main')
@section('head')
<script>
  var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();

    function readMaterial()
    {
              $.ajax({
          type : 'get',
          url  : '{{route("o.readMat")}}',
          dataType : 'html',
          success:function(data)
          {
              $('.table-material').html(data);
              // $('[data-toggle="tooltip"]').tooltip();
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
          }
        })
    }

    function readEquipment()
    {
        $.ajax({
          type : 'get',
          url  : '{{route("o.readEquip")}}',
          dataType : 'html',
          success:function(data)
          {
              $('.table-equipment').html(data);
              // $('[data-toggle="tooltip"]').tooltip();
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
          }
        })
    }

    function readWorker()
    {
        $.ajax({
          type : 'get',
          url  : '{{route("o.readWorker")}}',
          dataType : 'html',
          success:function(data)
          {
              $('.table-worker').html(data);
              // $('[data-toggle="tooltip"]').tooltip();
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
          }
        })
    }

     function findMatbyClass(val)
      {
        $('#material').empty().trigger('chosen:updated');
        $('#uom').val('').trigger('chosen:updated');
        var opt;
        var a;
        var newSelect = document.getElementById("material");
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        if($('#materialClass').val() == "")
        {
          $.get('findMatbyNone', function (data) {
           $(function(){
            $.bootstrapGrowl('<h4>Materials Found!</h4> <p>Materials matches the filter!</p>', {
              type: 'info',
              allow_dismiss: true
            });
          });
          for(a=0;a<data.length;a++)
          {
            opt = new Option(data[a].MaterialName,data[a].id);
            newSelect.appendChild(opt);
          }
          $('#material').trigger('chosen:updated');
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          })
        }
        else
        {
          $.get('findMatbyClass/' + val, function (data) {
            if(data.length == 0)
            {
              $(function(){
                $.bootstrapGrowl('<h4>Not Found!</h4> <p>No Material matches the filter!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
              $('#price').val('0');
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
            }
            else
            {
               $(function(){
                $.bootstrapGrowl('<h4>Materials Found!</h4> <p>Materials matches the filter!</p>', {
                  type: 'info',
                  allow_dismiss: true
                });
              });
              for(a=0;a<data.length;a++)
              {
                opt = new Option(data[a].MaterialName,data[a].id);
                newSelect.appendChild(opt);
              }
              $('#material').trigger('chosen:updated');
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
              findPrice(data[0].id);
            }
          })
        }
      }

    function findMatbyUOM(val)
      {
        $('#material').empty().trigger('chosen:updated');
        $('#materialClass').val('').trigger('chosen:updated');
        var opt;
        var a;
        var newSelect = document.getElementById("material");
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        if($('#uom').val() == "")
        {
          $.get('findMatbyNone', function (data) {
           $(function(){
            $.bootstrapGrowl('<h4>Materials Found!</h4> <p>Materials matches the filter!</p>', {
              type: 'info',
              allow_dismiss: true
            });
          });
          for(a=0;a<data.length;a++)
          {
            opt = new Option(data[a].MaterialName,data[a].id);
            newSelect.appendChild(opt);
          }
          $('#material').trigger('chosen:updated');
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          })
        }
        else
        {
          $.get('findMatbyUOM/' + val, function (data) {
            if(data.length == 0)
            {
              $(function(){
                $.bootstrapGrowl('<h4>Not Found!</h4> <p>No Material matches the filter!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
              $('#price').val('0');
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
            }
            else
            {
               $(function(){
                $.bootstrapGrowl('<h4>Materials Found!</h4> <p>Materials matches the filter!</p>', {
                  type: 'info',
                  allow_dismiss: true
                });
              });
              for(a=0;a<data.length;a++)
              {
                opt = new Option(data[a].MaterialName,data[a].id);
                newSelect.appendChild(opt);
              }
              $('#material').trigger('chosen:updated');
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
              findPrice(data[0].id);
            }
          })
        }
      }
    
  

   
    function findPrice(val)
    {
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#price').val('');
          var a4;
          $.get('getMatPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#price').val(data[a4].MaterialUnitPrice);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }

    function compute(val)
    {
      /////////////////start top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
      $('#cost').val('');
      var price = $('#price').val();
      var qty = val;
      var cost = price*qty;
      var newcost = (Math.round((cost * 1000)/10)/100).toFixed(2);
      $('#cost').val(newcost); 
      /////////////////stop top loading//////////
      NProgress.done();
      ///////////////////////////////////////////
    }
        
         
     function findRPD(val)
    {
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#rpd').val('');
          var a4;
          $.get('findRPD/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#rpd').val(data[a4].rpd);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }


    function addWorkFee(val)
    {
      /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          var a;
          $('#addworkfee_submit').text("Please Wait...");
           $('#workfee_val').val("");
           $('#workfee_desc').val("");

          $.get('findFee/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              $('#workfee_val').val(data[a].FeeValue);
              $('#workfee_desc').val(data[a].FeeDesc);
              $('#addwork').val(data[a].id);

            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          $('#addworkfee_submit').text('Add');

    }
     function addMatFee(val)
    {
      /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          var a;
          $('#addmatfee_submit').text("Please Wait...");
           $('#matfee_val').val("");
           $('#matfee_desc').val("");
           
          $.get('findFee/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              $('#matfee_val').val(data[a].FeeValue);
              $('#matfee_desc').val(data[a].FeeDesc);
              $('#addmat').val(data[a].id);

            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          $('#addmatfee_submit').text("Add");

    }
     var wbool = true;
    var mbool = true;

    function wcheck()
    {
     if(wbool)
    {
      $('#addworkfee_div').html('<a id="workfee"><i class="gi gi-plus"></i> <strong>Add Additional Fee</strong></a>');
    }
}
function mcheck()
{
     if(mbool)
     {
      $('#addmatfee_div').html('<a id="matfee"><i class="gi gi-plus"></i> <strong>Add Additional Fee</strong></a>');
     }


    }
   

    readMaterial();
    readEquipment();
    readWorker();
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
        <li><a href="">Add </a></li>

    </ol>
        
       <div class="row">
            {!! Form::open(['url'=>'o/task', 'method'=>'POST', 'id'=>'frm-insert']) !!}  
                
             @include('layouts.O.mainte.tasks.form')
         
            {!! Form::close() !!}
          <br>
        </div>
@endsection

@section('script')
 <script>
    $(document).ready(function(){
    var selfName = '';
    var id='';
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });  
      //hide
      $('span#duplicate').hide();
      $('span#duplicate1').hide();
      $('span#duplicate2').hide();


    //    $('#serveName').focus(function(){
    //   $('span#duplicate5').hide();
    // });

    //   $('#duration').focus(function(){
    //   $('span#duplicate6').hide();
    // });

    //   $('#unit').focus(function(){
    //   $('span#duplicate7').hide();
    // });
      //hide
       $('#material').focus(function(){
      $('span#duplicate').hide();
     });
       //hide
       $('#materialqty').focus(function(){
      $('span#duplicate2').hide();
     });

       $('#equipname').focus(function(){
      $('span#duplicate2').hide();
     });

       $('#specname').focus(function(){
      $('span#duplicate').hide();
     });

       $('#workerqty').focus(function(){
      $('span#duplicate3').hide();
     });


    //AddBtn matModal reset
    $('.addmatBtn').click(function(){
      $('.select-chosen').val('').trigger('chosen:updated');
       $('span#duplicate').hide();
      $('span#duplicate1').hide();
      $('span#duplicate2').hide();
       $('#materialqty').val("");
       $('#price').val("");
       $('#cost').val("");
      $('#addmat_modal').modal('show');
    });

    $('.addequiBtn').click(function(){
      $('.select-chosen').val('').trigger('chosen:updated');
      $('span#duplicate').hide();
      $('span#duplicate1').hide();
      $('span#duplicate2').hide();
       $('#equipprice').val("");
      $('#addequip_modal').modal('show');
    });

    $('.addworkBtn').click(function(){
      $('.select-chosen').val('').trigger('chosen:updated');
      $('span#duplicate').hide();
      $('span#duplicate1').hide();
      $('span#duplicate3').hide();
       $('#workerqty').val("");
      $('#addworker_modal').modal('show');
    });

    var worker = [];
    var workerqty = [];
    var rpd=[];
    
    $('#addworker').click(function(){
      var name = $('#specname').val();
      // var out_name = $('#specname').text();
       var qty = $('#workerqty').val();
       var out_rpd = $('#rpd').val();
       // alert(name);

       if(name.trim() != "")
          {
            if(qty.trim() != "")
             {
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'getSpec'+'/'+name; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                    worker.push(name);
                    workerqty.push(qty);
                    rpd.push(out_rpd);
                  wcheck();
                  $('#tblworker').append('<tr><td class="text-center">'+data.SpecDesc+'</td><td class="text-center">'+qty+'</td></tr>');
                  $('#addworker_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot assign this Skill!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
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
          $('span#duplicate').text("Fill up required");
          $('span#duplicate').show();
        }

    });
     var material = [];
     var price = [];
     var materialqty = [];
     var cost = [];
     

     $('#addmaterial').click(function(){

      var name = $('#material').val();
      // var out_name = $('#material').text();
       var out_price = $('#price').val();
       var out_qty = $('#materialqty').val();
       var out_cost = $('#cost').val();

       if(name.trim() != "")
          {
          if(out_qty.trim() != "")
          {  
            /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'getMat'+'/'+name; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                      material.push(name);
                      // price.push(out_price);
                      materialqty.push(out_qty);
                      cost.push(out_cost);
                      mcheck();
            $('#tblmaterial').append('<tr><td class="text-center">'+data.MaterialName+'</td><td class="text-center">'+out_price+'</td><td class="text-center">'+out_qty+'</td><td class="text-center">'+out_cost+'</td></tr>');
            $('#addmat_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot assign this Material!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
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
     

      

    });

     var equipname = [];
     var equipprice = [];

      $('#addequipment').click(function(){
      var name = $('#equipname').val();
      var out_name = $('#equipname').text();
       var out_price = $('#equipprice').val();

        if(name.trim() != "")
          {
            /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'getEqui'+'/'+name; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                      equipname.push(name);
                      equipprice.push(out_price);

                $('#tblequipment').append('<tr><td class="text-center">'+data.EquipName+'</td><td class="text-center">'+out_price+'</td></tr>');
                $('#addequip_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot assign this Material!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
                }
              })
             
           }
          else
          {
            $('span#duplicate2').text("Fill up required");
            $('span#duplicate2').show();
          }

    });
      // function Getday()
      // {
      //    var tot=0;
      //   for (var i = $('.servduration').length; i > 0; i--) 
      //   {
      //     // alert(i);
      //      days = $('#servduration'+i).val(); 
      //      console.log(days);
      //      tot += parseFloat(days);
            
      //   }
            
      //   total_days=tot;
      //   $('#duration').val(total_days);
      // }

      // var total_days='';
      // var days=0;
      // $(this).on('change','.servduration',function(){
      //   Getday();
      // });
      //Addtional Fee for Worker
      $(this).on('click','#workfee',function(){
        $('#addworkfee_modal').modal('show');
      });

       var workfeeval ="";
      $('#addworkfee_submit').click(function(){
    
       workfeeval = $('#workfee_val').val();
        var workfeedesc = $('#workfee_desc').val();
        if(workfeeval.trim() != "")
          {
        $('#addworkfee_div').html('<table class="table table-vcenter table-striped table-condensed"><tbody><tr class="active"><td class="text-center"><strong>ADD: </strong> </td><td class="text-center">'+workfeeval+'% '+workfeedesc+'</td></tr></tbody></table>');
        var wbool = false;
        $('#addworkfee_modal').modal('hide');
        }
          else
          {
            $('span#duplicate').text("This field is required!");
            $('span#duplicate').show();
          }

      });
      //Additional Fee for Materials
      $(this).on('click','#matfee',function(){
        $('#addmatfee_modal').modal('show');
      });
       var matfeeval="";

       $('#addmatfee_submit').click(function(){

         matfeeval = $('#matfee_val').val();
        var matfeedesc = $('#matfee_desc').val();
        if(matfeeval.trim() != "")
          {
        $('#addmatfee_div').html('<table class="table table-vcenter table-striped table-condensed"><tbody><tr class="active"><td class="text-center"><strong>ADD: </strong> </td><td class="text-center">'+matfeeval+'% '+matfeedesc+'</td></tr></tbody></table>');
        var mbool = false;
        $('#addmatfee_modal').modal('hide');
        }
          else
          {
            $('span#duplicates').text("This field is required!");
            $('span#duplicates').show();
          }
      });


       //insert data
      $('#frm-insert').on('submit', function(e){
        // $('span#duplicate').hide();
        e.preventDefault();
            /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
            var ddata = {
                service: $('#service').val(),
                taskname: $('#taskname').val(),
                duration: $('#duration').val(),
                servdesc: $('#servdesc').val(),
                worker: worker,
                workerqty: workerqty,
                rpd: rpd,
                material: material,
                cost: cost,
                materialqty: materialqty,
                equipprice: equipprice,
                equipname: equipname,
                // servtask: $('#servtask').val(),
                // servduration: $('.servduration').val(),
                workfeeval: workfeeval,
                matfeeval: matfeeval,
                addworkfee: $('#addwork').val(),
                addmatfee: $('#addmat').val()

            }
            // var ddata = $('#frm-insert').serialize();
            // console.log(ddata);
            $.ajax({
              type : 'post',
              data : ddata,
              dataType: 'json',
              url : "/o/task",
              success:function(data){
              swal("Success","Task Added!", "success");
              window.location = '/o/task';

                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
              },
              error:function(data){
                $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Task not Added!</p>', {
                  type: 'warning',
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


//CLONE 
//Worker
// $(function () {
    // $('#btnAdd').click(function () {
    //     var num     = $('.clone_task').length, 
    //         newNum  = new Number(num + 1),
    //         newhue = newNum-1,    
    //         newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum); 
        
    //     newElem.find('#servtask').attr('id', 'servtask').attr('name','servtask[]').val("");
    //      newElem.find('#servduration'+newhue).attr('id', 'servduration'+newNum).attr('name','servduration[]').val("");
    //     newElem.find('#num').text(newNum)

    //     $('#entry' + num).after(newElem);
    //     $('#servtask').focus();

    //     $('#btnDel').attr('disabled', false);

    //     if (newNum == 999999)
    //     $('#btnAdd').attr('disabled', true);
    // });

    // $('#btnDel').click(function () {
    //             var num = $('.clone_task').length;
    //             $('#entry' + num).slideUp('slow', function () {$(this).remove();
    //                 if (num -1 === 1)
    //                  { 
    //                   $('#btnDel').attr('disabled', true);
    //                   $('#btnAdd').attr('disabled', false);
    //                  }
    //             Getday();

    //         });
    //     return false;
    // });
    // $('#btnAdd').attr('disabled', false);
    // $('#btnDel').attr('disabled', true);


// //Material
//     $('.addmatBtn').click(function () {
//         var num     = $('.clone_material').length, 
//             newNum  = new Number(num + 1),     
//             newElem = $('#material' + num).clone().attr('id', 'material' + newNum).fadeIn('slow'); 
        
//         newElem.find('#material').attr('id', 'material').attr('name','material[]');
//         $('#material' + num).after(newElem);
//         $('#material').focus();

//         $('.delmatBtn').attr('disabled', false);

//         if (newNum == 999999)
//         $('.addmatBtn').attr('disabled', true);
//     });

//     $('.delmatBtn').click(function () {
//                 var num = $('.clone_material').length;
    
//                 $('#material' + num).slideUp('slow', function () {$(this).remove();
//                     if (num -1 === 1)
//                      { 
//                       $('.delmatBtn').attr('disabled', true);
//                       $('.addmatBtn').attr('disabled', false);
//                      }
//             });
//         return false;
//     });
//     $('.addmatBtn').attr('disabled', false);
//     $('.delmatBtn').attr('disabled', true);


// //Equipment
//     $('.addequiBtn').click(function () {
//         var num     = $('.clone_equip').length, 
//             newNum  = new Number(num + 1),     
//             newElem = $('#equipment' + num).clone().attr('id', 'equipment' + newNum).fadeIn('slow'); 
        
//         newElem.find('#equipment').attr('id', 'equipment').attr('name','equipment[]');
//         $('#equipment' + num).after(newElem);
//         $('#equipment').focus();

//         $('.delequiBtn').attr('disabled', false);

//         if (newNum == 999999)
//         $('.addequiBtn').attr('disabled', true);
//     });

//     $('.delequiBtn').click(function () {
//                 var num = $('.clone_equip').length;
    
//                 $('#equipment' + num).slideUp('slow', function () {$(this).remove();
//                     if (num -1 === 1)
//                      { 
//                       $('.delequiBtn').attr('disabled', true);
//                       $('.addequiBtn').attr('disabled', false);
//                      }
//             });
//         return false;
//     });
//     $('.addequiBtn').attr('disabled', false);
//     $('.delequiBtn').attr('disabled', true);


// });

    

  });
  </script>
@endsection