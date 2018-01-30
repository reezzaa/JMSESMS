<table id="receive-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Contract Name</th>
      <th class="text-center">Client</th>
      <th class="text-center">From</th>
      <th class="text-center">Through</th>
      <th class="text-center">Status</th>
      <th style="width: 60px;" class="text-center"></th>
    </tr>
  </thead>
   <tbody id="bank-list">
    @foreach($cont as $key => $u)
    <tr id="id{{$u->id}}">
        <td class="text-center">
            {{ $u->conid }}
        </td>
        <td class="text-center">
            {{ $u->name }}
        </td>
       <td class="text-center">
            {{ $u->strCompClientName }}
        </td>
        <td class="text-center">
        {{\Carbon\Carbon::parse($u->from)->toFormattedDateString()}}
        </td>
        <td class="text-center">
        {{\Carbon\Carbon::parse($u->to)->toFormattedDateString()}}

        </td>
        <td class="text-center">
            @if($u->active==0)
            <label class="label label-danger">No Downpayment</label>
            @elseif($u->active==2)
            <label class="label label-warning">Paid Downpayment</label>
            @elseif($u->active==1)
            <label class="label label-success">CO Received</label>
            @endif
        </td>
        <td class="text-center">
            @if($u->active==0)
            <button class="btn btn-alt btn-warning" value = "{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Receive CO" disabled="disabled"><span class="fa fa-thumb-tack"></span>
            </button>
            @elseif($u->active==2)
            <button class="btn btn-alt btn-warning edit_supp" value = "{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Receive CO"><span class="fa fa-thumb-tack"></span>
            </button>
            @elseif($u->active==1)
            <label class="label label-success"></label>
            @endif
        </td>
       
    </tr>
    @endforeach
  </tbody>
</table>        
<!-- <div class="text-center">
     <div id="edit_modal" class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
             <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Edit Bank Name</strong></h3>
              </div>

              {!! Form::open(['url'=>'bank','method'=>'PUT','id'=>'frm-upd']) !!}
                <div class="form-group">
                    <label for="banknames">Bank Name <span class="text-danger">*</span> </label>
                    {!!Form::text('banknames' , null,['id'=>'banknames', 'class'=>'form-control', 'maxLength'=>'30'])!!}
                    <span id="duplicate" class="help-block animation-slideDown">
                    Duplicate Material Type Name
                    </span>
                    <script>
                        $('#banknames').alphanum({
                            allow :    '-,.()/', // Specify characters to allow
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
              <h3 class="themed-background" style="color:white;"><strong>Delete Bank Name</strong></h3>
            </div>
             {!!Form::open(['url'=>'bank','method'=>'PUT','id'=>'frm-del'])!!}
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
  </div> -->
<script>$(function(){ TablesDatatables.init(); });</script>