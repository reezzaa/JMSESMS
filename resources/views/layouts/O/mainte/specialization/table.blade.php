<table id="specialization-datatable" class="table table-vcenter table-striped table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Skill</th>
      <th class="text-center">Rate/Hour</th>
      <th class="text-center">Effectivity Date</th>
      <th style="width: 60px;" class="text-center"></th>
      <th style="width: 200px;" class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody>
    @foreach($spec as $key => $u)
    <tr>
        <td class="text-center">
            {{ $u->SpecDesc }}
        </td>
        <td class="text-center">
           ₱ {{ $u->rpd }}
        </td>
        <td class="text-center">
        {{\Carbon\Carbon::parse($u->date)->toFormattedDateString()}}
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
            <button id="view_supp" class="btn btn-alt btn-default view_supp" value = "{{$u->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Adjustment History"><span class="fa fa-history"></span>
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
                <th class="text-center">RATE</th>
              </tr>
            </thead>
            <tbody id="area" class="text-center">
              
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
           <div id="edit_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="block">
                    <div class="block-title themed-background">
                      <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;"><strong>Edit Skill</strong></h3>
                    </div>

                       {!! Form::open(['url'=>'skill','method'=>'PUT','id'=>'frm-upd']) !!}
                       <input type="hidden" id="specID" name="specID">
                        <div class="form-group">
                            <label for="SpecDesc">Skill Description</label><span class="text-danger">*</span> 
                          <div class="col-md-offset-1">
                            {!!Form::text('SpecDesc' , null,['id'=>'SpecDesc', 'class'=>'form-control', 'maxLength'=>'45'])!!}
                            <span id="duplicate" class="help-block animation-slideDown">
                            Duplicate Material Classification Name
                            </span>
                          </div>
                            <script>
                               $('#SpecDesc').alphanum({
                                  allow :    '-/', // Specify characters to allow
                                });
                            </script>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="rpds">Rate per Hour</label><span class="text-danger">*</span> 
                          <div class="col-md-offset-1">
                            {!! Form::text('rpds',null ,['id'=>'rpds','placeholder'=>'', 'class' => 'form-control', 'maxlength'=>'40']) !!}
                            <span id="duplicate1" class="help-block animation-slideDown">
                                Duplicate Material Classification Name
                            </span>
                          </div>
                            <script>
                            $('#rpds').numeric({
                                decimalSeparator: ".",
                                maxDecimalPlaces : 2,
                                allowMinus:   false
                            });
                            </script>
                        </div>
                         <div class="form-group">
                          <label for="specdate">Effectivity Date</label><span class="text-danger">*</span> 
                       <input type="text" id="specdates" name="specdates" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="">
                      </div>
                        <div class="pull-right">
                          <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                          <button type="submit" class="btn btn-primary" ><span class="gi gi-pen"></span> Save Changes</button>
                        </div>
                        {!!Form::close()!!}
                        <div class="clearfix"></div>
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
                      <h3 class="themed-background" style="color:white;"><strong>Delete Skill</strong></h3>
                    </div>
                     {!!Form::open(['url'=>'skill','method'=>'PUT','id'=>'frm-del'])!!}
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