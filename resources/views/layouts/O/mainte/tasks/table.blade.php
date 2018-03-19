<table id="serviceOff-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Service</th>
      <th class="text-center">Task</th>
      <th class="text-center">Price</th>
      <th class="text-center">Duration(days)</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 200px;" class="text-center">Controls</th>
    </tr>
  </thead>
   <tbody id="serve-list">
    @foreach($serve as $key => $u)
    <tr>
        <td class="text-center">
            {{ $u->ServiceOffName }}
        </td>
        <td class="text-center">
            {{ $u->ServTask }}
        </td>
        <td class="text-center">
           ₱ {{ $u->total }}
        </td>
        <td class="text-center">
           {{ $u->duration }}
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
            <button id="view_supp" class="btn btn-alt btn-info view_supp" value = "{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="View"><span class="gi gi-eye_open"></span>
            </button>
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
<div>
  <div id="view_modal" class="modal fade view_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="block">
        <div class="block-title themed-background">
          <div class="block-options pull-right">
              <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
          </div>
          <h3 class="themed-background" style="color:white;"><strong id="nameheader"></strong></h3>
        </div>

        <div class="row">
          <div class="col-md-6 " id="header">

          </div>
          <div class="col-md-6 " id="right">

          </div>
        </div>
        <div class="row" id="detail">

        </div>
        
        <div id="clearfix"></div>
      </div>
    </div>
  </div>
</div> 
   <div id="edit_modal" class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="block">
         <div class="block-title themed-background">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
            </div>
            <h3 class="themed-background" style="color:white;"><strong>Edit Service Offered</strong></h3>
          </div>

            {!! Form::open(['url'=>'serviceOff','method'=>'PUT','id'=>'frm-upd']) !!}
              <div class="form-group hidden">
                 <label for="serveID">Services Offered ID</label>
                {!!Form::text('serveID' , null,['id'=>'serveID', 'class'=> 'form-control','readonly'=>'readonly'])!!}
              </div>
              <div class="form-group">
                <label for="strServiceOffName">Service Offered Name <span class="text-danger">*</span> </label>
                {!!Form::text('strServiceOffName' , null,['id'=>'strServiceOffName', 'class'=>'form-control', 'maxLength'=>'200'])!!}
                <span id="duplicate" class="help-block animation-slideDown">
                Duplicate Service Offered Name
                </span>
                <script>
                $('#strServiceOffName').alpha({
                    allow :    '-,."/()', // Specify characters to allow
                  });
                </script>
              </div>
              <div class="pull-right">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" class="btn btn-primary" ><span class="gi gi-pen"></span> Save Changes</button>
              </div>
              <div class="clearfix"></div>
              <script>
                $('#strServiceOffName').focus(function(){
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
            <h3 class="themed-background" style="color:white;"><strong>Delete Specialization</strong></h3>
          </div>
           {!!Form::open(['url'=>'serviceOff','method'=>'PUT','id'=>'frm-del'])!!}
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
<script>$(function(){ TablesDatatables.init(); })</script>