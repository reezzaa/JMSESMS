<table id="equipment-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Name</th>
      <th class="text-center">Type</th>
      <th class="text-center">Key</th>
      <th class="text-center">Leaser </th>
      <th class="text-center">Status</th>
      <th class="text-center">Rental Amount</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 60px;" class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody id="equip-list">
    @foreach($equip as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
            {{ $u->EquipName }} 
        </td>
        <td class="text-center">
            {{$u->EquipTypeDesc}}
        </td>
        <td class="text-center">
            {{ $u->EquipKey }} 
        </td>
        <td class="text-center">
            {{ $u->EquipLeaser }} 
        </td>
        <td class="text-center">
             @if(($u->rent)==1)
                  Rented
              @else
                  Owned
              @endif
        </td>
        <td class="text-center">
         @if(($u->rent)==1)
                   ₱ {{ $u->EquipPrice }} 
              @else
                  --
              @endif
                
          
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
<div>
      <div id="edit_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block">
             <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Edit Equipment</strong></h3>
              </div>

               {!! Form::open(['url'=>'equipment','method'=>'PUT','id'=>'frm-update']) !!}
                  @include('layouts.O.mainte.equipment.formedit')
              <div class="clearfix"></div>
              <script>
                      $('span#duplicates').hide();
                      $('span#duplicates2').hide();
                      $('span#duplicate2').hide();
                      $('span#duplicate3').hide();
                      $('span#duplicatez3').hide();


                  $('#equiptypes').focus(function(){
                      $('span#duplicates').hide();
                     });
                  $('#equipnames').focus(function(){
                      $('span#duplicates2').hide();
                     });
                  $('#equipmodels').focus(function(){
                    $('span#duplicate2').hide();
                   });
                   $('#equipweights').focus(function(){
                    $('span#duplicate3').hide();
                   });
                   $('#equipkeys').focus(function(){
                    $('span#duplicatez3').hide();
                   });
                   $('#equipleasors').focus(function(){
                    $('span#duplicate3').hide();
                   });
                   $('#equipprices').focus(function(){
                    $('span#duplicate3').hide();
                   });
                </script>
              {!!Form::close()!!}
        </div>
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
            <h3 class="themed-background" style="color:white;"><strong>Delete Equipment</strong></h3>
          </div>
             {!!Form::open(['url'=>'equipment','method'=>'PUT','id'=>'frm-del'])!!}
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