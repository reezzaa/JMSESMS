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
        <div class="block">
          <div class="container">
              <div class="stepwizard">
                  <div class="stepwizard-row setup-panel">
                      <div class="stepwizard-step col-xs-3"> 
                          <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                          <p><small></small></p>
                      </div>
                      <div class="stepwizard-step col-xs-3"> 
                          <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                          <p><small></small></p>
                      </div>
                      <div class="stepwizard-step col-xs-3"> 
                          <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                          <p><small></small></p>
                      </div>
                      <div class="stepwizard-step col-xs-3"> 
                          <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                          <p><small></small></p>
                      </div>
                  </div>
              </div>
    
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
      $('#addtask_modal').modal('show');
    });

     var task = [];
     var price =[];
     
    $('#addtask').click(function(){
      var name = $('#task').val();
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
                  $('#tbltask').append('<tr id="'+data.id+'"><input type="hidden" value="'+data.total+'" id="input'+data.id+'"><td class="text-center">'+data.ServiceOffName+'</td><td class="text-center">'+data.ServTask+'</td><td class="text-center">'+data.total+'</td><td class="text-center"><button class="btn-alt btn-danger rem" value="'+data.id+'"><i class="fa fa-times"></i></button></td></tr>');
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
                task: task,
                progress: $('#progress').val(),
                term: $('#term').val(),
                termdate: $('#termdate').val(),
                vat: $('#vat').val(),
                vatrate: $('#vatrate_val').val(),
                newcost: newcost
            }
            $.ajax({
              type : 'post',
              url  : 'setup',
              data : ddata,
              dataType: 'json',
              success:function(data){
                 /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                window.location = 'receiveorder';
              },
              error:function(data){
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                $.bootstrapGrowl('<h4>Error!</h4> <p>Cannot Save!</p>', {
                        type: 'warning',
                        delay: '1700',
                        allow_dismiss: true
                      });
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