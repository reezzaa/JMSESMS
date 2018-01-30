<table id="worker-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Name</th>
      <th class="text-center">Province</th>
      <th class="text-center">City</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 200px;" class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody id="emp-list">
    @foreach($employ as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
            {{ $u->id }}
        </td>
        <td class="text-center">
            {{ $u->EmpFname }} {{ $u->EmpMname }} {{ $u->EmpLname }}
        </td>
        <td class="text-center">
            {{ $u->EmpProvince }}
        </td>
        <td class="text-center">
            {{ $u->EmpCity }}
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
<div id="viewemp_modal" class="modal fade view_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="block">
        <div class="block-title themed-background">
          <div class="block-options pull-right">
              <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
          </div>
          <h3 class="themed-background" style="color:white;"><strong id="nameheader"></strong></h3>
        </div>

        <div class="row">
          <div class="col-md-offset-1">
            <address>
                <h5><strong>Address:</strong> <span id="address"></span></h5><br>
                <h5><i class="fa fa-phone"></i> <span id="contactno"></span></h5><br>
                <h5><i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"> <span id="email"></span></a></h5>
            </address>
          </div>
        </div>
        <div class="row">
          <div class="col-md-offset-1">
            <h4><i class="fa fa-thumbs-o-up"></i> Specialization: </h4>
            <div class="col-md-5 col-md-offset-1">
              <div id="special"></div>
            </div>
            <div class="col-md-5">
              <div id="special2"></div>
            </div>
          </div>
        </div>
        
        <div id="clearfix"></div>
      </div>
    </div>
  </div>
</div> 

<div class="text-center">
   <div id="del_modal" class="modal fade delete-employee-modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="block">
          <div class="block-title themed-background">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
            </div>
            <h3 class="themed-background" style="color:white;"><strong>Delete Employee</strong></h3>
          </div>
             {!!Form::open(['url'=>'worker','method'=>'PUT','id'=>'frm-del'])!!}
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


<div class="text-center">
   <div id="empedit_modal" class="modal fade empedit_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSupplierModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="block">
          <div class="block-title themed-background">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
            </div>
            <h3 class="themed-background" style="color:white;"><strong>Edit Employee Information</strong></h3>
          </div>
            {!! Form::open(['url'=>'worker', 'method'=>'PATCH', 'id'=>'form-validation', 'class' => 'form-horizontal form-bordered']) !!}
              @include('layouts.O.mainte.employee.formedit')
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div> 
</div>

<script>$(function(){ TablesDatatables.init(); });</script>