<table id="material-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover" >
  <thead>
    <tr>
      <th class="text-center">Type</th>
      <th class="text-center">Classification</th>
      <th class="text-center">Material Name</th>
      <th class="text-center">UOM</th>
      <th class="text-center">Price</th>
      <th class="text-center">Supplier</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 175px;" class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody id="mat-list">
    @foreach($material as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
           {{ $u->MatTypeName }}
        </td>
        <td class="text-center">
            {{ $u->MatClassName }}
        </td>
        <td class="text-center">
            {{ $u->MaterialName }}
        </td>
        <td class="text-center">
            {{ $u->DetailUOMText }}
        </td>
        <td class="text-center">
           ₱ {{ $u->MaterialUnitPrice }}  <br>
           <i> {{\Carbon\Carbon::parse($u->date)->toDayDateTimeString()}}</i>
        </td>
        <td class="text-center">
            {{ $u->SuppDesc }}
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
             
            <button id="show_supp" class="btn btn-alt btn-default show_supp" value = "{{$u->matID}}" data-toggle="tooltip" data-placement="top" data-original-title="Adjustment History"><span class="fa fa-history"></span>
            </button>
            <button id="view_supp" class="btn btn-alt btn-info view_supp" value = "{{$u->matID}}" data-toggle="tooltip" data-placement="top" data-original-title="View"><span class="gi gi-eye_open"></span>
            </button>
            <button id="edit_supp" class="btn btn-alt btn-warning edit_supp" value = "{{$u->matID}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><span class="gi gi-pencil"></span>
            </button>
            <button id="del_supp" class="btn btn-alt btn-danger del_supp" value="{{$u->matID}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <span class="gi gi-bin"></span>
            </button>
          </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table> 
  <div id="show_stock_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
              <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;" id="name"></h3></div>
                 <table class="table table-vcenter table-striped table-borderless table-hover" style="font-family: 'Arial'">
            <thead>
              <tr>
                <th class="text-center">DATE</th>
                <th class="text-center">PRICE</th>
              </tr>
            </thead>
            <tbody id="area" class="text-center">
              
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
<div id="view_modal" class="modal fade view_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
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

<div id="edit_modal" class="modal fade editmat_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="block">
        <div class="block-title themed-background">
          <div class="block-options pull-right">
              <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
          </div>
          <h3 class="themed-background" style="color:white;"><strong id="nameheader">Edit Material</strong></h3>
        </div>
        {!! Form::open(['url'=>'material', 'method'=>'PUT', 'id'=>'form-validation', 'class' => 'form-horizontal']) !!}
          @include('layouts.O.mainte.material.formedit')
        {!! Form::close() !!}
        <div id="clearfix"></div>
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
           {!!Form::open(['url'=>'material','method'=>'PUT','id'=>'frm-del'])!!}
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