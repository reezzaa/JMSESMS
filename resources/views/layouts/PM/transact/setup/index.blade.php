@extends('layouts.PM.transact.transact_main')
@section('head')
<script>
 function findTask(val)
      {
        $('#task').empty().trigger('chosen:updated');
        var opt;
        var a;
        var newSelect = document.getElementById("task");
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        if($('#service').val() == "")
        {
          $.get('setup/findTaskbyNone', function (data) {
           $(function(){
            $.bootstrapGrowl('<h4>Tasks Found!</h4> <p>Tasks matches the filter!</p>', {
              type: 'info',
              allow_dismiss: true
            });
          });
          for(a=0;a<data.length;a++)
          {
            opt = new Option(data[a].ServTask,data[a].id);
            newSelect.appendChild(opt);
          }
          $('#task').trigger('chosen:updated');
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
          })
        }
        else
        {
          $.get('setup/findTaskbyService/' + val, function (data) {
            if(data.length == 0)
            {
              $(function(){
                $.bootstrapGrowl('<h4>Not Found!</h4> <p>No Task matches the filter!</p>', {
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
                $.bootstrapGrowl('<h4>Tasks Found!</h4> <p>Tasks matches the filter!</p>', {
                  type: 'info',
                  allow_dismiss: true
                });
              });
              for(a=0;a<data.length;a++)
              {
                opt = new Option(data[a].ServTask,data[a].id);
                newSelect.appendChild(opt);
              }
              $('#task').trigger('chosen:updated');
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
          $.get('setup/getTaskPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#price').val(data[a4].total);
              $('#duration').val(data[a4].duration);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }
    function findExpPrice(val)
    {
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#miscprice').val('');
          var a4;
          $.get('setup/getExpPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#miscprice').val(data[a4].MiscValue);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }
    function findRateValue(val)
    {
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#value').val('');
          var a4;
          $.get('setup/getRateValue/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#value').val(data[a4].RateValue);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }
     var subtotal=0;
     var vatdue=0;
     var total=0;
     var newcost=0;
function computetax()
    {
    var getRate=  $('#vat').text();
    vatdue= subtotal*(getRate/100);
    $('#vatdue').text('₱ '+vatdue);
    $('#vatrate').text(getRate+' %');
    $('#vatrate_val').val(getRate);
    total = parseFloat(subtotal)+parseFloat(vatdue);
    newcost = (Math.round((total * 1000)/10)/100).toFixed(2);

    $('#totaldue').text('₱ '+newcost);
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
  <div class="content-header">
      <div class="header-section">
        <h4>
            <i class="gi gi-adjust_alt"> </i> Setup Contract <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Setup Contract</a></li>
  </ol>
        <!-- <div class="block"> -->
          <div class="container">
              <div class="stepwizard">
                  <div class="stepwizard-row setup-panel">
                      <div class="stepwizard-step col-xs-4"> 
                          <a href="#step-1" type="button" class="btn btn-success btn-circle"><i class="fa fa-files-o"></i></a>
                          <p><small>Contract Details</small></p>
                      </div>
                      <div class="stepwizard-step col-xs-4"> 
                          <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-sliders"></i></a>
                          <p><small>Scope of Works</small></p>
                      </div>
                      <div class="stepwizard-step col-xs-4"> 
                          <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-briefcase"></i></a>
                          <p><small>Commercial Terms</small></p>
                      </div>
                  </div>
              <!-- </div> -->
    
    {!! Form::open(['url'=>'o/task', 'method'=>'POST', 'id'=>'frm-insert']) !!}  
                
             @include('layouts.PM.transact.setup.form')
         
            {!! Form::close() !!}
</div>
          
        </div>
          <br>
 
   
@endsection


@section('script')
 <script>
   $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $('.addtaskBtn').click(function(){
      $('#task').val('').trigger('chosen:updated');
      $('#service').val('').trigger('chosen:updated');
       $('span#duplicate').hide();
       $('#price').val("");
       $('#task_from').val("");
       // $('#task_to').val("");
       $('#duration').val("");
      $('#addtask_modal').modal('show');
    });
  $('.addexpBtn').click(function(){
      $('#misc').val('').trigger('chosen:updated');
       $('span#duplicate').hide();
       $('#miscprice').val("");
       // $('#task_from').val("");
       // $('#task_to').val("");
       // $('#duration').val("");
      $('#addexp_modal').modal('show');
    });
    $('.addrateBtn').click(function(){
      $('#rate').val('').trigger('chosen:updated');
       $('span#duplicate').hide();
       $('#value').val("");
       // $('#task_from').val("");
       // $('#task_to').val("");
       // $('#duration').val("");
      $('#addrate_modal').modal('show');
    });

     var task = [];
     var price =[];
     var task_from =[];
     // var task_to =[];
     var duration =[];
     // var min='';
     // var max='';
    $('#addtask').click(function(){
      var name = $('#task').val();
      var from = $('#task_from').val();
      // var to = $('#task_to').val();
      var dur = $('#duration').val();

                    // if(min =='')
                    // {
                    //   min = from;
                    // } 
                    // else if(min>from)
                    // {
                    //   min = from;
                    // }
                    // else
                    // {
                    //   min = min;
                    // }
                    // if(max =='')
                    // {
                    //   max = to;
                    // } 
                    // else if(max<to)
                    // {
                    //   max = to;
                    // }
                    // else
                    // {
                    //   max =max;
                    // }
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'setup/getTask'+'/'+name; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                    task.push(name);
                    task_from.push(from);
                    // task_to.push(to);
                    duration.push(dur);
                  $('#tbltask').append('<tr id="'+data.id+'"><input type="hidden" value="'+data.total+'" id="input'+data.id+'"><td class="text-center">'+data.ServiceOffName+'</td><td class="text-center">'+data.ServTask+'</td><td class="text-center">'+data.total+'</td><td class="text-center">'+duration+'</td><td class="text-center">'+from+'</td><td class="text-center"><button class="btn-danger rem" value="'+data.id+'"><i class="fa fa-times"></i></button></td></tr>');
                     subtotal+=parseFloat(data.total);
                  $('#subtotal').text('₱ '+subtotal);
                  if($('#totaldue').text()!="")
                  {
                  computetax();

                  }
                  console.log(task);

                  $('#addtask_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot Add this Task!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
                }
              })
          

    });
    var miscdesc=[];
    var miscvalue=[];
    $('#addmisc').click(function(){
      var desc = $('#misc').val();
      var val = $('#miscprice').val();
      // var to = $('#task_to').val();
      // var dur = $('#duration').val();

                 
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'setup/getMisc'+'/'+desc; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                    miscdesc.push(desc);
                    miscvalue.push(val);
                    
                  $('#tblexp').append('<tr id="'+data.id+'"><input type="hidden" value="'+data.MiscValue+'" id="input'+data.id+'"><td class="text-center">'+data.MiscDesc+'</td><td class="text-center">'+data.MiscValue+'</td><td class="text-center"></tr>');
                     subtotal+=parseFloat(data.MiscValue);
                  $('#subtotal').text('₱ '+subtotal);
                  if($('#totaldue').text()!="")
                  {
                  computetax();

                  }
                  console.log(subtotal);

                  $('#addexp_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot Add this Expense!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
                }
              })
          

    });
    var ratedesc=[];
    var ratevalue=[];
    $('#addrate').click(function(){
      var desc = $('#rate').val();
      var val = $('#value').val();
      var initial=0;
      // var to = $('#task_to').val();
      // var dur = $('#duration').val();

                 
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              var mod_url = 'setup/getRate'+'/'+desc; 
              var a='';
              $.ajax({
                type : 'get',
                url  : mod_url,
                dataType: 'json',
                success:function(data){
                    ratedesc.push(desc);
                    ratevalue.push(val);
                    
                  $('#tblfees').append('<tr id="'+data.id+'"><input type="hidden" value="'+data.RateValue+'" id="input'+data.id+'"><td class="text-center">'+data.RateDesc+'</td><td class="text-center">'+data.RateValue+'</td><td class="text-center"></tr>');
                     initial= data.RateValue/100 * subtotal;
                     subtotal+=parseFloat(initial);
                  $('#subtotal').text('₱ '+subtotal);
                  if($('#totaldue').text()!="")
                  {
                  computetax();

                  }
                  console.log(data.RateValue);
                  console.log(initial);
                  console.log(subtotal);

                  $('#addrate_modal').modal('hide');
                   /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                    },
                error:function(data){
                    $(function(){
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot Add this Expense!</p>', {
                  type: 'warning',
                  allow_dismiss: true
                });
              });
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                   
                }
              })
          

    });
    

    $(this).on('click','.rem',function(){
      /////////////////start top loading//////////
              NProgress.start();
      ///////////////////////////////////////////
      var getID = $(this).val();
      var getvalue = $('#input'+getID+'').val();
      // alert(getvalue);
      subtotal=subtotal-getvalue;
      $('#subtotal').text('₱ '+subtotal);
      computetax();
      $('#'+getID+'').slideUp('slow', function () {$(this).remove()
      });
      task.pop();
      task_from.pop();
      // task_to.pop();
      duration.pop();
      /////////////////start top loading//////////
      NProgress.done();
      ///////////////////////////////////////////
    });
   

     $('#frm-insert').on('submit', function(e){
        e.preventDefault();
        
            /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
            var ddata = {
                client: $('#client').val(),
                contractname: $('#contractname').val(),
                datesigned: $('#datesigned').val(),
                from: $('#from').val(),
                to: $('#to').val(),
                location: $('#location').val(),
                co: $('#co').val(),
                co_date: $('#co_date').val(),
                task: task,
                task_from: task_from,
                // task_to: task_to,
                duration: duration,
                miscdesc: miscdesc,
                ratedesc: ratedesc,
                progress: $('#progress').val(),
                term: $('#term').val(),
                termdate: $('#termdate').val(),
                vat: $('#vat').val(),
                vatrate: $('#vatrate_val').val(),
                newcost: newcost
            }
            // alert(min);
            // alert(max);
            $.ajax({
              type : 'post',
              url  : 'setup',
              data : ddata,
              dataType: 'json',
              success:function(data){
                 /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                window.location = '/pm/contract';
              },
              error:function(data){
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                // window.location = 'contract';
                
              }
            })
          
          e.stopPropagation();
        });



    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    
    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='date']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        // if(('#client').val()=='')
        // {
        //   $(this).closest('.form-group').addClass("has-error");
        // }
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');

    
});
 </script>
@endsection