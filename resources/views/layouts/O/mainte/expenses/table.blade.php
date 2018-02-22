<table id="expense-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Description</th>
      <th class="text-center">Amount</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 200px;" class="text-center">Controls</th>
    </tr>
  </thead>
   <tbody id="bank-list">
    @foreach($misc as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
            {{ $u->MiscDesc }}
        </td>
        <td class="text-center">
            ₱ {{ $u->MiscValue }}
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
                <h3 class="themed-background" style="color:white;"><strong>Edit Expense</strong></h3>
              </div>

              {!! Form::open(['url'=>'expenses','method'=>'PUT','id'=>'frm-upd']) !!}
                <div class="form-group">
                    <label for="exdescs">Expense Description <span class="text-danger">*</span> </label>
                    {!!Form::text('exdescs' , null,['id'=>'exdescs', 'class'=>'form-control', 'maxLength'=>'30'])!!}
                    <span id="duplicate" class="help-block animation-slideDown">
                    Duplicate Material Type Name
                    </span>
                    <script>
                        $('#exdescs').alphanum({
                            allow :    '-,.()/', // Specify characters to allow
                          });
                      </script>
                    </div>
                <div class="form-group">
                    <label for="exvalues">Amount  <span class="text-danger">*</span> </label>
                    {!!Form::text('exvalues' , null,['id'=>'exvalues', 'class'=>'form-control', 'maxLength'=>'30'])!!}
                    <span id="duplicate1" class="help-block animation-slideDown">
                    Duplicate Material Type Name
                    </span>
                   <script>
                   $('#exvalues').numeric({
                     decimalSeparator: ".",
                      maxDecimalPlaces : 2,
                      allowMinus:   false
                      });
                    </script>
                    </div>
                <br>
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
              <h3 class="themed-background" style="color:white;"><strong>Delete Expense</strong></h3>
            </div>
             {!!Form::open(['url'=>'expenses','method'=>'PUT','id'=>'frm-del'])!!}
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
<script>$(function(){ TablesDatatables.init(); });</script>