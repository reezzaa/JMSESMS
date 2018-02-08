@extends('layouts.PM.transact.transact_main')
@section('head')
<script>
var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();
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
            <i class="hi hi-list"> </i> Manage Contract <br>
        </h4>
      </div>
  </div>
  <ol class="breadcrumb breadcrumb-top">
      <li><a href="{{ route('pm.home') }}"><i class="fa fa-home"></i></a></li>
      <li><a>Manage Contract</a></li>
      <li><a>{{$id}}</a></li>
  </ol>
    <div class="block">
      <div class="block-title themed-background">
          <h3 class="themed-background" style="color:white;"><strong>Tasks List</strong></h3>
          </div>
          <table>
            <tr>
              <td></td>
            </tr>
          </table>
       <table id="8col-datatable" class="table table-vcenter table-striped table-bordered table-hover">
                              <thead>
                              <tr>
                                <th class="text-center">Task</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">WT. %</th>
                                <th class="text-center">COMP. %</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:150px"></th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr class="active">
                                  <td class="text-center"><h5><b>{{$o_contname->name}}</b></h5></td>
                                  <td class="text-center"><h5><b>{{\Carbon\Carbon::parse($o_contfrom->from)->toFormattedDateString()}}</b></h5></td>
                                  <td class="text-center"><h5><b>{{\Carbon\Carbon::parse($o_contto->to)->toFormattedDateString()}}</b></h5></td>
                                  <td class="text-center"><h5><b>{{$ov_dur}} day/s</b></h5></td>
                                  <td class="text-center"><h5><b>{{$o_wt}} %</b></h5></td>
                                  <td class="text-center">
                                     @if($o_com=='')
                                      <h5 style="color: red"><b>0%</b></h5>  
                                     @else
                                      <h5 style="color: green"><b>{{$o_com}} %</b></h5>  
                                     @endif  
                                  </td>
                                  <td class="text-center"><h5><b></b></h5></td>
                                  <td class="text-center"><h5><b></b></h5></td>
                                </tr>
                                @foreach($task as $t)

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
                                   @endif                              
                                 </td>
                                 <td class="text-center">
                                    @if(($t->status==1))
                                      @if($t->p_prog==100)
                                      <span class="label label-primary ">Finished</span>
                                       @else     
                                      <span class="label label-primary">On Schedule</span>
                                        @endif
                                    @elseif($t->status==2)
                                      @if($t->p_prog==100)
                                      <span class="label label-info ">Finished</span>
                                       @else     
                                      <span class="label label-info">Ahead</span>
                                      @endif
                                    @elseif($t->status==3)
                                      @if($t->p_prog==100)
                                      <span class="label label-danger ">Finished</span>
                                       @else     
                                      <span class="label label-danger">Delayed</span>
                                      @endif
                                    @endif
                                   </td>

                                <td class="text-center">
                                  <button class="btn btn-info upd" data-toggle="tooltip" data-placement="top" data-original-title="Update" value="{{$t->id}}">Update</button>
                                  <button class="btn btn-alt btn-default" data-toggle="tooltip" data-placement="top" data-original-title="View">View</button>
                                  </td>
                              </tr>
                                @endforeach
                              
                              </tbody>
                            </table>
    <br>
    </div>

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
    });
 </script>
@endsection