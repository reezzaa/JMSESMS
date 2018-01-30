 <script>
   function readByAjax()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdrate.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Rate</strong>  <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
 </script>
 <div>
   {!! Form::open(['url'=>'bdrate', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                      <div class="col-md-5">
                          <div class="form-group">
                          <label for="ratedesc">Description</label> <span class="text-danger">*</span> 
                          {!! Form::text('ratedesc', null,  ['id'=>'ratedesc','class'=>'form-control', 'placeholder'=>'e.g Overtime, etc.']) !!}
                          <span id="duplicate1" class="help-block animation-slideDown">
                              Duplicate Material Name
                          </span>
                          <script>
                              $('#ratedesc').alphanum({
                                      allow :    '-,.()/', // Specify characters to allow
                                    });
                            </script>
                        </div>
                      </div>
                      <div class="col-md-5">
                          <div class="form-group">
                            <label for="ratevalue">Rate Value</label> <span class="text-danger">*</span>
                            {!! Form::text('ratevalue',null ,['id'=>'ratevalue','placeholder'=>'e.g. 99999', 'class' => 'form-control', 'maxlength'=>'30']) !!}
                            <span id="duplicate" class="help-block animation-slideDown">
                              Duplicate Material Name
                            </span>
                            <script>
                              $('#ratevalue').numeric({
                                decimalSeparator: ".",
                                maxDecimalPlaces : 2,
                                allowMinus:   false
                            });
                            </script>
                          </div>
                      </div>
                    <label for="ratevalue"></label>
                        <br>
                  <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add</button>
                        
                      </div>
                    </div>               
                <div class="clearfix"></div>
              {!! Form::close() !!}
 </div>

 <hr>
 <table id="rate-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">Description</th>
        <th class="text-center">Rate Value</th>
        <th style="width: 60px;" class="text-center"></th>
        <th style="width: 60px;" class="text-center">Controls</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rate as $key => $u)
      <tr id="id{{$u->id}}">
          <td class="text-center">
              {{ $u->RateDesc }}
          </td>
          <td class="text-center">
              {{ $u->RateValue }} %
          </td>
          <td class="text-center">
          <label class="switch switch-primary">
            @if(($u->status)==1)
                  <p hidden>1</p>
              @else
                  <p hidden>0</p> 
              @endif
            <input name="status" id="status" type="checkbox" value="{{ $u->id }}" 
              @if(($u->status)==1)
                  {{"checked"}}
              @else
                  {{""}} 
              @endif
              >
              <span></span></label>
          </td>
          <td>
            <div class="text-center">
              <button id="edit_supp" class="btn btn-alt btn-warning edit_supp" value = "{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><span class="gi gi-pencil"></span>
              </button>
              <button id="del_supp" class="btn btn-alt btn-danger del_supp" value="{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <span class="gi gi-bin"></span>
              </button>
          </div>

      </td>
  </tr>
  @endforeach
</tbody>
</table>
<div class="text-center">
<div id="edit_modal" class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
              <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Edit Rate</strong></h3>
              </div>

              {!! Form::open(['url'=>'bdrate','method'=>'PUT','id'=>'frm-upd']) !!}
              <div class="form-group">
                 <label for="ratedescs">Description</label> 
                 <span class="text-danger">*</span> 
                  {!! Form::text('ratedescs', null,  ['id'=>'ratedescs','class'=>'form-control', 'placeholder'=>'e.g Overtime, etc.']) !!}
                  <span id="duplicate1" class="help-block animation-slideDown">
                  Duplicate Material Classification Name
                  </span>
                   <script>
                    $('#ratedescs').alphanum({
                     allow :    '-,.()/', // Specify characters to allow
                   });
                </script>
              </div>
              <div class="form-group">
                <label for="ratevalues">Rate Value</label> <span class="text-danger">*</span>
                {!! Form::text('ratevalues',null ,['id'=>'ratevalues','placeholder'=>'e.g. 99999', 'class' => 'form-control', 'maxlength'=>'30']) !!}
                  <span id="duplicate" class="help-block animation-slideDown">
                     Duplicate Material Name
                  </span>
                  <script>
                    $('#ratevalues').numeric({
                      decimalSeparator: ".",
                      maxDecimalPlaces : 2,
                      allowMinus:   false
                    });
                 </script>
              </div>
              <div class="pull-right">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" class="btn btn-primary" ><span class="gi gi-pen"></span> Save Changes</button>
              </div>
              <div class="clearfix"></div>
              <script>
                $('#EquipTypeDesc').focus(function(){
                    $('span#duplicate').hide();
                   });
            </script>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div> 
  </div>
<div class="text-center">
    <div id="del_modal" class="modal fade del_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="block">
         <div class="block-title themed-background">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
            </div>
            <h3 class="themed-background" style="color:white;"><strong>Delete Rate</strong></h3>
          </div>
           {!!Form::open(['url'=>'{{ route(bd.utilities.rate.del)}}','method'=>'PUT','id'=>'frm-del'])!!}
                <p><h4>Are you sure you want to delete</h4>
                </p>
                <p hidden><b id="deleteID"></b></p>
                <p>
                  <h3><b id="del_classname" ></b>??</h3>
                </p>
              <div class="pull-right">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" class="btn btn-primary" ><span class="gi gi-pen"></span>Delete</button>
            </div>
            <div class="clearfix"></div>
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div> 
</div>
<br><br>

<script>$(function(){ TablesDatatables.init(); });</script>
 <script>
  $('span#duplicate').hide();
  $('span#duplicate1').hide();
  $(document).ready(function(){
      var selfName = '';
      var className = '';
      var id='';
      var url = "bdrate";
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 
      /////////////////////////////////////////////////////
      //clear on focus
      $('#ratedesc').focus(function(){
        $('span#duplicate1').hide();
       });
       $('#ratevalue').focus(function(){
        $('span#duplicate').hide();
       });
         ////////////////////////////////////////////////////////

        $('#frm-insert').on('submit', function(e){
        $('span#duplicate').hide();
        $('span#duplicate1').hide();
        e.preventDefault();
        if($('#ratedesc').val() != "")
        {
          if($('#ratevalue').val() != "")
            {
                          /////////////////start top loading//////////
                          NProgress.start();
                          ///////////////////////////////////////////
                          var ddata = {
                            desc: $('#ratedesc').val(),
                            value: $('#ratevalue').val(),
                          } 
                          $.ajax({
                            type : 'post',
                            url  : url,
                            data : ddata,
                            dataType: 'json',
                            success:function(data){
                              readByAjax();
                              $(".modal").modal('hide');
                              swal("Success","Rate Added!", "success");
                            },
                            error:function(data){
                              /////////////////stop top loading//////////
                              NProgress.done();
                              ///////////////////////////////////////////
                               $('span#duplicate1').text("Duplicate Rate Description!");
                               $('span#duplicate1').show();
                            }
                          })
                    }
                 
          else
          {
            $('span#duplicate').text("Fill up required");
            $('span#duplicate').show();
          }
        }
        else
        {
          $('span#duplicate1').text("Fill up required");
          $('span#duplicate1').show();
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
          $('span#duplicates4').hide();
          var classID = $(this).val();
          id = classID;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#ratedescs').val(data.RateDesc);
                $('#ratevalues').val(data.RateValue);
                selfName = $('#ratedescs').val();
                className = $('#ratevalues').val();
                $('#edit_modal').modal('show');
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });

       //update edit data
      $(this).on('submit' ,function(e){
        
         $('span#duplicates').hide();
         $('span#duplicates1').hide();
          e.preventDefault();
          
          if($('#ratedescs').val() != "")
        {
           if($('#ratevalues').val() != "")
            {
                       
                          if(selfName == $('#ratedescs').val() && className == $('#ratevalues').val())
                          {
                            swal("Info", "Same Rate Information", "info");
                          }
                          else
                          { 
                            /////////////////start top loading//////////
                            NProgress.start();
                            ///////////////////////////////////////////
                            var formData = {
                                    RateDesc: $('#ratedescs').val(),
                                    RateValue : $('#ratevalues').val()
                              }
                            var mod_url = url+'/'+id;
                            $.ajax({
                              type : 'put',
                              url  : mod_url,
                              data : formData,
                              dataType: 'json',
                              success:function(data){
                                readByAjax();
                                $(".modal").modal('hide');
                                swal("Success","Rate Edited!", "success");
                              },
                              error:function(data){
                                  /////////////////stop top loading//////////
                                  NProgress.done();
                                  ///////////////////////////////////////////
                                 $('span#duplicates1').text("Duplicate Rate Name");
                                 $('span#duplicates1').show();
                              }
                            })
                          }
                       }
                 
          else
          {
            $('span#duplicate').text("Fill up required");
            $('span#duplicate').show();
          }
        }
        else
        {
          $('span#duplicate1').text("Fill up required");
          $('span#duplicate1').show();
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
            $('#del_classname').text(data.RateDesc);
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