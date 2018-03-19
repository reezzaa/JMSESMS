@extends('layouts.PM.transact.transact_main')
@section('head')
<script>
var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();


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
          $.get('findTaskbyNone', function (data) {
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
          $.get('findTaskbyService/' + val, function (data) {
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
        $('#duration').val('');
          var a4;
          $.get('getTaskPrice/' + val, function (data) {
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


   function findTaskJob(val)
   {
    /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#task_job').empty().trigger('chosen:updated');
         var opt;
        var a;
        var newSelect = document.getElementById("task_job");
         $.get('getNewTaskJob/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              opt = new Option(data[a].SpecDesc ,data[a].specid);
              newSelect.appendChild(opt);

            }
              $('#task_job').trigger('chosen:updated');
              findRPD(data[0].specid);

          }
        });

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
              $('#job_name').val("ADDED: "+ data[a4].SpecDesc);
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
    }
   function findTaskMat(val)
   {
    /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $('#task_mat').empty().trigger('chosen:updated');
         var opt;
        var a;
        var newSelect = document.getElementById("task_mat");
         $.get('getNewTaskMat/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              opt = new Option(data[a].MaterialName ,data[a].matid);
              newSelect.appendChild(opt);

            }
              $('#task_mat').trigger('chosen:updated');
              findMatPrice(data[0].matid);

          }
        });

    /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
   }
   function findMatPrice(val)
   {
    /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
       
        var a;
         $.get('getTaskMatPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
            
              $('#matprice').val(data[a].MaterialUnitPrice);
              $('#mat_name').val("ADDED: "+data[a].MaterialName);
            }

          }
        });

    /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
   }
   function findEPrice(val)
   {
    /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
       
        var a;
         $.get('getTaskEPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
            
              $('#equipprice').val(data[a].EquipPrice);
              $('#equip_name').val("ADDED: "+data[a].EquipName);
            }

          }
        });

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
          $.get('/pm/setup/getExpPrice/' + val, function (data) {
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
     function findFee(val)
    {
      /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          var a;
           $('#wfee').val("");
          $.get('findFee/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              $('#wfee').val(data[a].FeeValue);
              console.log
            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////

    }
    function findMFee(val)
    {
      /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          var a;
           $('#mfee').val("");
           
          $.get('findFee/' + val, function (data) {
          if(data.length != 0)
          {
            for(a=0;a<data.length;a++)
            {
              $('#mfee').val(data[a].FeeValue);

            }
          }
        })
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////

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
            <i class="hi hi-list"> </i> Contract Management <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Contract Management</a></li>
      <li><a>{{$id}}</a></li>
  </ol>
    <div class="block">
      <div class="block-title themed-background">
          <h3 class="themed-background" style="color:white;"><strong>Tasks List</strong></h3>
          </div>
         <div class="row">
           <div class="col-md-3 col-md-offset-1">
             @foreach($cont as $cont)
              Contract Name: {{$cont->name}}  <br>
              Client:  <a href="{{ route('client.show',$cont->ClientID)}}">{{$cont->strCompClientName}}</a><br>
              Contract Period: {{\Carbon\Carbon::parse($cont->from)->toFormattedDateString()}} - {{\Carbon\Carbon::parse($cont->to)->toFormattedDateString()}}
           </div>
           <div class="col-md-3 col-md-offset-1">
              Contract Order #: {{$cont->co}}  <br>
              Released Date:  {{\Carbon\Carbon::parse($cont->co_date)->toFormattedDateString()}}<br>
             @endforeach
              Starting Date: {{\Carbon\Carbon::parse($o_contfrom)->toFormattedDateString()}}

           </div>
            <div class="col-md-4">
               <span>WT%: <i>Work Time Percentage</i></span><br>
                <span>COMP%: <i>Completion Percentage</i></span>
            </div>
         </div>
         <br>
                
              <div class="btn-group col-md-12">
                <h4 class="col-md-7 col-md-offset-0" style="color: green"><strong>Overall Progress: {{$o_com}}%</strong></h4>
                @if($check_init==0)
                  @if($o_com == 100)
                   <button  id="turnover" class="btn btn-default"><i class=""></i> Start Progress Inspection</button>
                   @else
                   <button  id="turnover" class="btn btn-default disabled"><i class=""></i> Start Progress Inspection</button>
                   @endif
                @elseif($check_init!=0)
                    @if($check==0)
                   <button  id="closing" class="btn btn-default disabled"><i class=""></i> Final Inspection</button>
                    @else
                   <button  id="closing" class="btn btn-default"><i class=""></i> Final Inspection</button>
                    @endif
                @endif

                 <button  id="add_task" class="btn btn-default "><i class="fa fa-calendar-o"></i> Add Task </button>
                 <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Add Resources</button>
                    <ul class="dropdown-menu dropdown-custom">
                      <li>
                        <a id="add_job">Job</a>
                        <a id="add_mat">Material</a>
                        <a id="add_equip">Equipment</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <!-- <a id="add_misc">Miscellaneous Fees</a> -->
                        <!-- <a id="add_exp">Expenses</a> -->
                      </li>
                  </ul>
                 </div>
              </div>
        
          
          <hr>
        
       <table id="7cols-datatable" class="table table-vcenter table-striped table-bordered table-hover">
                              <thead>
                              <tr>
                                <th class="text-center">Task</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">WT. %</th>
                                <th class="text-center">COMP. %</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:150px">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                                <!-- <tr class="active" >
                                  <td class="text-center"><h5><b></b></h5></td>
                                  <td class="text-center"><h5><b>{{\Carbon\Carbon::parse($o_contfrom)->toFormattedDateString()}}</b></h5></td>
                                  <td class="text-center"><h5><b>{{\Carbon\Carbon::parse($o_contto)->toFormattedDateString()}}</b></h5></td>
                                  <td class="text-center"><h5><b>{{$ov_dur}} day/s</b></h5></td>
                                  <td class="text-center"><h5><b>100 %</b></h5></td>
                                  <td class="text-center">
                                     @if($o_com=='')
                                      <h5 style="color: red"><b>0%</b></h5>  
                                     @else
                                      <h5 style="color: green"><b>{{$o_com}} %</b></h5>  
                                     @endif  
                                  </td>
                                  <td class="text-center"><h5><b></b></h5></td>
                                  <td class="text-center"><h5><b></b></h5></td>
                                </tr> -->
                                @foreach($o_task as $t)
                              <tr>
                                <td class="text-center">
                                    {{ $t ->ServTask}}
                                </td>
                                <td class="text-center">
                                  {{\Carbon\Carbon::parse($t->task_from)->toFormattedDateString()}}
                                </td>
                                <td class="text-center">
                                    {{\Carbon\Carbon::parse($t->task_to)->toFormattedDateString()}}
                                </td>
                                <td class="text-center">
                                   {{ $t ->duration}} day/s
                                </td>
                                <td class="text-center">
                                   {{$t->wt}} %                        
                               </td>
                                <td class="text-center">
                                   @if($t->p_prog=='')
                                   0%
                                   @else
                                   {{$t->p_prog}} %   
                                   <br>
                                   <b>As Of {{\Carbon\Carbon::parse($t->d_date)->toFormattedDateString()}}</b>
                                   @endif                              
                                 </td>
                                 <td class="text-center">
                                    @if(($t->status==1))
                                      @if($t->percent==100)
                                      <span class="label label-primary ">Finished</span>
                                       @else     
                                      <span class="label label-primary">On Schedule</span>
                                        @endif
                                    @elseif($t->status==2)
                                      @if($t->percent==100)
                                      <span class="label label-info ">Finished</span>
                                       @else     
                                      <span class="label label-info">Ahead of Schedule</span>
                                      @endif
                                    @elseif($t->status==3)
                                      @if($t->percent==100)
                                      <span class="label label-danger ">Finished</span>
                                       @else     
                                      <span class="label label-danger">Behind Schedule</span>
                                      @endif
                                    @else
                                      <span class="label label-default ">Pending for action</span>


                                    @endif
                                   </td>

                                <td class="text-center">
                                  <button class="btn btn-sm btn-info upd" value="{{$t->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Update"><span class="gi gi-pencil"></span></button>
                                  <button class="btn btn-sm btn-alt btn-default his" value="{{$t->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Update History"><span class="fa fa-history"></span></button>
                                  <button class="btn btn-sm btn-danger del" value="{{$t->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Remove Task"> <span class="gi gi-bin"></button>
                                  </td>
                              </tr>
                            
                                @endforeach
                              
                              </tbody>
                            </table>
    <br>
    </div>
    @include('layouts.PM.transact.contract.incurrences')
    <div id="show_modal" class="modal fade show_modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
             <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Update Task</strong></h3>
              </div>

                 
                        {!! Form::open(['url'=>'contract','method'=>'PUT','id'=>'form-validation']) !!}
                         
                          <input type="hidden" id="task">
                              <div class="form-group">
                              <label class=" control-label col-md-5 text-center" for="val_range">Set Progress(<em>percentage</em>)  <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                  {!! Form::number('val_range',  null,  ['id'=>'val_range','class'=>'form-control', 'placeholder'=>'Range[0-100]']) !!}
                                </div>
                              </div><br><br>
                             <div class="form-actions form-group">
                               <button type="submit" class="btn btn-info pull-right">Save</button> 
                             </div>
                      <div class="clearfix"></div>

                        {!!Form::close()!!} 
                    </div>
                <br>
          </div>
        </div>
      </div>

      <div id="addtask_modal" class="modal fade add-spec-modal" tabindex="-1" role="dialog" aria-labelledby="AddSpecModal" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="block">
                                  <div class="block-title themed-background">
                                    <div class="block-options pull-right">
                                        <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                                    </div>
                                    <h3 class="themed-background" style="color:white;"><strong>Add Task</strong></h3>
                                  </div>
                                   {!! Form::open(['url'=>'contract/storeTask/{{id}}', 'method'=>'POST', 'id'=>'frm-insert-task']) !!}  
                                    <div class="row">
                                      <div class="col-md-0">
                                        &nbsp;<span class="fa fa-filter"> </span>  Filter by:
                                      </div><br>
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="service">Service</label>
                                            <select id="service" name="service" onchange="findTask(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Filter by Service">
                                              <option></option>
                                              <option value=""></option>
                                              @foreach($service as $service)
                                              <option value="{{$service->id}}">{{$service->ServiceOffName}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      
                                    </div>
                                    <br>
                                    <div class="row">
                                      <div class="col-md-9">
                                        <div class="form-group">
                                          <div>
                                            <label for="material">Task</label> <span class="text-danger">*</span>
                                            <select id="task_o" name="task_o" onchange="findPrice(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Select Task">
                                              <option></option>
                                               @foreach($task as $task)
                                              <option value="{{$task->id}}">{{$task->ServTask}}</option>
                                              @endforeach
                                            </select>
                                            <!-- <span id="duplicate" class="help-block animation-slideDown">
                                                  Duplicate Material Classification Name
                                            </span> -->
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <div>
                                            <label for="price">Cost</label>
                                            {!! Form::text('text',null ,['id'=>'price','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <div>
                                            <label for="duration">Duration</label>
                                            {!! Form::text('text',null ,['id'=>'duration','placeholder'=>'0', 'class' => 'form-control', 'maxlength'=>'30','disabled'=>'disabled']) !!}
                                          </div>
                                        </div>
                                      </div>
                                       <div class="form-group col-md-8">
                                          <label class="control-label" for="example-daterange1">Task Period <span class="text-danger">*</span></label>
                                          <!-- <div class="input-group input-daterange" data-date-format="yyyy-mm-dd"> -->
                                                  <input type="text" id="task_from" name="task_from" class="form-control text-center val input-datepicker" placeholder="From" required="required" data-date-format="yyyy-mm-dd">
                                                  <!-- <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> -->
                                                  <!-- <input type="text" id="task_to" name="task_to" class="form-control text-center val" placeholder="To" required="required"> -->
                                          </div>
                                        
                                    </div>
                                      
                                      </div>
                                   <!-- <hr> -->
                                   <input type="hidden" id="ov" value="{{$ov->over_dur}}">
                                   
                                    <div class="col-md-offset-10">
                                        <button type="submit" class="btn btn-primary btn-alt">Add ></button> 
                                    </div><br>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                          <!-- </div> -->

<div class="text-center">
    <div id="del_modal" class="modal fade del_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Remove Task</strong></h3>
            </div>
             {!!Form::open(['url'=>'contract','method'=>'POST','id'=>'frm-del'])!!}
                  <p><h4>Are you sure you want to remove </h4>
                  </p>
                  <p hidden><b id="deleteID"></b></p>
                  <p>
                    <h3><b id="del_classname" ></b>??</h3>
                  </p>
                  <input type="hidden" id="durar">
                  <input type="hidden" id="name">
                  <input type="hidden" id="total">
                  <input type="hidden" id="ov_rem" value="{{$ov->over_dur}}">
                <div class="pull-right">
                  <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                  <button type="submit" class="btn btn-primary" ><span class="gi gi-pen"></span>Remove</button>
              </div>
              <div class="clearfix"></div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
</div>
       <div id="initial_modal" class="modal fade del_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Progress Inspection</strong></h3>
            </div>
             {!!Form::open(['url'=>'/pm/contract/turnover','method'=>'POST','id'=>'frm-init'])!!}
                   <div class="form-group">
                      <label for="">Official Date of Start <span class="text-danger">*</span></label>
                      <input type="text" id="off_date" name="off_date" class="form-control text-center val input-datepicker" placeholder="date" required="required" data-date-format="yyyy-mm-dd">
                   </div>
                   <div class="form-group">
                      <label for="">Date of Inspection </label>
                       <input type="text" id="ins_date" name="ins_date" class="form-control text-center val input-datepicker" placeholder="date" required="required" data-date-format="yyyy-mm-dd">
                   </div>
                   <div class="form-group">
                      <label for="">Target % Completion <span class="text-danger">*</span></label>
                      <input type="text" id="targ" name="targ" class="form-control" value="100">
                   </div>
                   <div class="form-group">
                      <label for="">Actual % Completion <span class="text-danger">*</span></label>
                      <input type="text" id="actual" name="actual" class="form-control" value="100">
                   </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary" >Proceed</button>
              </div>
              <div class="clearfix"></div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
           <div id="final_modal" class="modal fade del_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Final Inspection</strong></h3>
            </div>
             {!!Form::open(['url'=>'contract','method'=>'POST','id'=>'frm-fin'])!!}
                   <div class="form-group">
                      <label for="">Date of Final Inspection <span class="text-danger">*</span></label>
                      <input type="text" id="fin_date" name="fin_date" class="form-control text-center val input-datepicker" placeholder="date" required="required" data-date-format="yyyy-mm-dd">
                   </div>
                   <div class="form-group">
                      <label for="">Actual Date of Completion </label>
                      <input type="text" id="act_date" name="act_date" class="form-control text-center val input-datepicker" placeholder="date" required="required" data-date-format="yyyy-mm-dd">
                   </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary" > Proceed</button>
              </div>
              <div class="clearfix"></div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
    <div id="history_modal" class="modal fade del_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
            <div class="block-title themed-background">
              <div class="block-options pull-right">
                  <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
              </div>
              <h3 class="themed-background" style="color:white;"><strong>Update History</strong></h3>
            </div>
                   <table class="table table-hover table-striped table-vcenter">
                    <thead>
                       <tr>
                       <th class="text-center">Date Updated</th>
                       <th class="text-center">Progress Percentage</th>
                     </tr>
                    </thead>
                    <tbody id="area">
                      
                    </tbody>
                   </table>
              <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
@endsection


@section('script')
<script>$(function(){ TablesDatatables.init(); });</script>
  <script>$(function(){ FormsValidation.init(); });</script>

 <script>
   $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.upd').on('click',function(){
        NProgress.start();
        var classID = $(this).val();
        $('#task').val(classID);
        $('#show_modal').modal('show');
        NProgress.done();
      });

      $(this).on('submit','#form-validation',function(e){
        e.preventDefault();

        var $form = $(this);
        if(! $form.valid()) return false;
          var formData =  
              {
                taskID: $('#task').val(),
                progress: $('#val_range').val()
              }
           /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              $.ajax({
                type : 'put',
                url  : '/pm/contract/'+lastPart,
                data : formData,
                dataType: 'json',
                success:function(data){
                    /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                  $(".modal").modal('hide');
                  window.location.reload();

                },
                error:function(data){
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                alert('error');
                 
                }
              })          
           e.stopPropagation();
      });
     $(this).on('click','#add_task',function(){
      NProgress.start();
            $('#addtask_modal').modal('show');
       /////////////////stop top loading//////////
              NProgress.done();
        ///////////////////////////////////////////
    });

     //hide
      $('span#duplicate').hide();
      $('span#duplicate1').hide();
      $('span#duplicate2').hide();
      $('span#duplicate3').hide();



    var ov= $('#ov').val();

   

    $('#frm-insert-task').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        ServID: $('#task_o').val(),
        from: $('#task_from').val(),
        ov: ov,
        price: $('#price').val(),
        duration: $('#duration').val()
        // to: $('#task_to').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/storeTask/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                swal("Success","Task Added!", "success");
               
                window.location.reload();

                },
                
              })
      NProgress.done();

    });

      $(this).on('click','.del', function(){
      /////////////////start top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
      var classe = $(this).val();
      $.get( classe + '/edit', function (data) {
            $('#deleteID').text(data.con_id);
            $('#del_classname').text(data.ServTask);
            $('#name').val("REMOVED: "+data.ServTask);
            $('#durar').val(data.duration);
            $('#total').val(data.total);
            $('#del_modal').modal('show');
            /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
        })
      });
              

       $('#frm-del').on('submit',function(e){
        /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
          e.preventDefault();
            var ddata = {
              ContractID: lastPart,
              taskid: $('#deleteID').text(),
              ov_rem: $('#ov_rem').val(),
              name: $('#name').val(),
              zero: "0",
              total: $('#total').val(),
              dura: $('#durar').val()
            }

            console.log(ddata);
            $.ajax({
              type : 'post',
              url  : '/pm/contract',
              data : ddata,
              dataType: 'json',
              success:function(data){
                $(".modal").modal('hide');
                swal("Removed!", "", "success");
                window.location.reload();
              }
            })
           e.stopPropagation();
        }); 

      $('#add_job').on('click',function(){
      NProgress.start();
        $('#new_task').val('').trigger('chosen:updated');  
        $('#task_job').val('').trigger('chosen:updated'); 
        $('#workerqty').val('');
        $('#addworkfee').val('').trigger('chosen:updated'); 
        $('#addworker_modal').modal('show');
        NProgress.done();
    });

    $('#frm-newjob').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        TaskID: $('#new_task').val(),
        SpecID: $('#task_job').val(),
        FeeID: $('#addworkfee').val(),
        rpd: $('#rpd').val(),
        getfee: $('#wfee').val(),
        name: $('#job_name').val(),
        quantity: $('#workerqty').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/newJob/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#addworker_modal').modal('hide');
                swal("Success","Job Added!", "success");
                window.location.reload();

                },
                
              })
      NProgress.done();

    });
    $('#add_mat').on('click',function(){
      NProgress.start();
        $('#new_mtask').val('').trigger('chosen:updated');  
        $('#task_mat').val('').trigger('chosen:updated'); 
        $('#price').val('');
        $('#matqty').val('');
        $('#addmatfee').val('').trigger('chosen:updated'); 
        $('#addmat_modal').modal('show');
        NProgress.done();
    });
    $('#frm-newmat').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        TaskID: $('#new_mtask').val(),
        MatID: $('#task_mat').val(),
        FeeID: $('#addmatfee').val(),
        price: $('#matprice').val(),
        getfee: $('#mfee').val(),
        name: $('#mat_name').val(),
        quantity: $('#matqty').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/newMat/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#addmat_modal').modal('hide');
                swal("Success","Material Added!", "success");
                window.location.reload();

                },
                
              })
      NProgress.done();

    });

    $('#add_equip').on('click',function(){
      NProgress.start();
        $('#new_etask').val('').trigger('chosen:updated');  
        $('#task_equip').val('').trigger('chosen:updated'); 
        $('#equipprice').val('');
        $('#addequip_modal').modal('show');
        NProgress.done();
    });
    $('#frm-newequip').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        TaskID: $('#new_etask').val(),
        name: $('#equip_name').val(),
        EquipID: $('#task_equip').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/newEquip/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#addequip_modal').modal('hide');
                swal("Success","Equipment Added!", "success");
                window.location.reload();

                },
                
              })
      NProgress.done();

    });
    $('#add_misc').on('click',function(){
      NProgress.start();
        $('#rate').val('').trigger('chosen:updated'); 
        $('#addrate_modal').modal('show');
        NProgress.done();
    });
    $('#frm-newmisc').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        RateID: $('#rate').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/newMisc/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#addmisc_modal').modal('hide');
                swal("Success","Miscellaneous Fee Added!", "success");
                window.location.reload();

                },
                
              })
      NProgress.done();

    });
    $('#add_exp').on('click',function(){
      NProgress.start();
        $('#misc').val('').trigger('chosen:updated'); 
        $('#miscprice').val('');
        $('#addexp_modal').modal('show');
        NProgress.done();
    });
    $('#frm-newexp').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        MiscID: $('#misc').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/newExp/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#addexp_modal').modal('hide');
                swal("Success","Expense Added!", "success");
                window.location.reload();

                },
                
              })
      NProgress.done();

    });

    $(this).on('click','#turnover',function(){
      $('#off_date').val('');
      $('#ins_date').val('');
      $('#initial_modal').modal('show');
    });
    $('#frm-init').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        officialstartdate: $('#off_date').val(),
        start: $('#ins_date').val(),
        target: $('#targ').val(),
        actual: $('#actual').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/turnover/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#initial_modal').modal('hide');
                window.location.reload();

                },
                
              })
      NProgress.done();

    });
    $(this).on('click','#closing',function(){
      $('#fin_date').val('');
      $('#act_date').val('');
      $('#final_modal').modal('show');
    });
    $('#frm-fin').on('submit',function(e){
      e.preventDefault();
      var ddata = {
        ContractID: lastPart,
        officialenddate: $('#fin_date').val(),
        enddate: $('#act_date').val()
      }
      console.log(ddata);
      NProgress.start();

        $.ajax({
                type : 'post',
                url  : '/pm/contract/closing/'+lastPart,
                data : ddata,
                dataType: 'json',
                success:function(data){
                $('#final_modal').modal('hide');
                window.open('/pm/contract/printTurnover/'+lastPart);

                },
                
              })
      NProgress.done();

    });

    $(this).on('click','.his',function(){
      var classID = $(this).val();
          var a,b=0;
          // $('#myId').val(classID);

         /////////////////top loading//////////
          NProgress.start();
          /////////////////////////////////////
          $.ajax({
          type : 'get',
          url  : '/pm/contract/updateHistory/'+classID,
          dataType: 'json',
          success:function(data){
            for(a=0;a<data.length;a++)
            {
                document.getElementById("area").innerHTML += '<tr><td class="text-center"><strong>'+data[a].date+'</strong></td><td class="text-center"><strong>'+data[a].percent+' %</strong></td></tr>';

            }
            
                $('#history_modal').modal('show');
            
          }
          });

           /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
          $('#area').empty();
    });







    });
 </script>
@endsection