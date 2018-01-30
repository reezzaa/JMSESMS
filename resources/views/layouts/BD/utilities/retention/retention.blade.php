 <script>
   function readByAjax()
    {
      /////////////////stop top loading//////////
      NProgress.start();
      ///////////////////////////////////////////
        $.ajax({
          type : 'get',
          url  : "{{ route('bdretention.index') }}",
          dataType : 'html',
          success:function(data)
          {
              $('.table-responsive').html(data);

              // $('[data-toggle="tooltip"]').tooltip();
              $('#title').html('<strong>Retention</strong> <i role="button" class="gi gi-circle_info" data-toggle="tooltip" data-placement="bottom" title="Rate!"></i>');
          }
        })
         /////////////////stop top loading//////////
          NProgress.done();
         ///////////////////////////////////////////
    };
 </script>
 <div>
   {!! Form::open(['url'=>'bdretention', 'method'=>'POST', 'id'=>'frm-insert']) !!}
                      <div class="col-md-12">
                          <div class="form-group">
                          <label for="retention" class="col-md-3">Retention Value <span class="text-danger">*</span></label> 
                         <div class="col-md-7">
                            {!! Form::text('retention', null,  ['id'=>'retention','class'=>'form-control', 'placeholder'=>'e.g 99999, etc.']) !!}
                         </div>
                          <span id="duplicate1" class="help-block animation-slideDown">
                              Duplicate Material Name
                          </span>
                          <script>
                              $('#retention').numeric({
                                decimalSeparator: ".",
                                maxDecimalPlaces : 2,
                                allowMinus:   false
                            });
                            </script>
                  <button type="submit" class="btn btn-primary"><span class="gi gi-plus"></span> Add</button>

                        </div>

                      </div>
                      
                        
                      </div>
                    </div>               
                <div class="clearfix"></div>
              {!! Form::close() !!}
 </div>
 
 <hr>
 <table id="form-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">Retention</th>
        <th style="width: 60px;" class="text-center"></th>
        <th style="width: 200px;" class="text-center">Controls</th>
      </tr>
    </thead>
    <tbody>
      @foreach($retention as $key => $u)
      <tr id="id{{$u->id}}">
          <td class="text-center">
              {{ $u->RetValue }} %
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
                <h3 class="themed-background" style="color:white;"><strong>Edit Retention</strong></h3>
              </div>

              {!! Form::open(['url'=>'{{ route(bd.utilities.retention)}}','method'=>'PUT','id'=>'frm-upd']) !!}
              <div class="form-group">
                 <label for="retentions">Retention Value</label> 
                 <span class="text-danger">*</span> 
                  {!! Form::text('retentions', null,  ['id'=>'retentions','class'=>'form-control', 'placeholder'=>'e.g 99999, etc.']) !!}
                  <span id="duplicate1" class="help-block animation-slideDown">
                  Duplicate Material Classification Name
                  </span>
                   <script>
                     $('#retentions').numeric({
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
            <h3 class="themed-background" style="color:white;"><strong>Delete Form of Payment</strong></h3>
          </div>
           {!!Form::open(['url'=>'{{ route(bd.utilities.retention.del)}}','method'=>'PUT','id'=>'frm-del'])!!}
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
  $('span#duplicate1').hide();
  $(document).ready(function(){
      var selfName = '';
      var className = '';
      var id='';
      var url = "bdretention";
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 
      /////////////////////////////////////////////////////
      //clear on focus
      $('#retention').focus(function(){
        $('span#duplicate1').hide();
       });
         ////////////////////////////////////////////////////////

        $('#frm-insert').on('submit', function(e){
        $('span#duplicate1').hide();
        e.preventDefault();
        if($('#retention').val() != "")
        {
        
                          /////////////////start top loading//////////
                          NProgress.start();
                          ///////////////////////////////////////////
                          var ddata = {
                            value: $('#retention').val(),
                          } 
                          $.ajax({
                            type : 'post',
                            url  : url,
                            data : ddata,
                            dataType: 'json',
                            success:function(data){
                              readByAjax();
                              $(".modal").modal('hide');
                              swal("Success","Retention Added!", "success");
                            },
                            error:function(data){
                              /////////////////stop top loading//////////
                              NProgress.done();
                              ///////////////////////////////////////////
                               $('span#duplicate1').text("Duplicate Retention Value!");
                               $('span#duplicate1').show();
                            }
                          })
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
          $('span#duplicates1').hide();
          var classID = $(this).val();
          id = classID;
          $.get(url + '/' + classID + '/edit', function (data) {
                $('#retentions').val(data.RetValue);
                selfName = $('#retentions').val();
                $('#edit_modal').modal('show');
                /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
            })
      });

       //update edit data
      $(this).on('submit' ,function(e){
        
         $('span#duplicates1').hide();
          e.preventDefault();
          
          if($('#retentions').val() != "")
        {                       
                          if(selfName == $('#retentions').val())
                          {
                            swal("Info", "Same Retention Value", "info");
                          }
                          else
                          { 
                            /////////////////start top loading//////////
                            NProgress.start();
                            ///////////////////////////////////////////
                            var formData = {
                                    RetValue: $('#retentions').val(),
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
                                swal("Success","Retention Edited!", "success");
                              },
                              error:function(data){
                                  /////////////////stop top loading//////////
                                  NProgress.done();
                                  ///////////////////////////////////////////
                                 $('span#duplicates1').text("Duplicate Retention Description");
                                 $('span#duplicates1').show();
                              }
                            })
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
            $('#del_classname').text(data.RetValue);
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