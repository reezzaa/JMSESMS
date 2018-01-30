<table id="stock-datatable" class="table table-vcenter table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">Material Name</th>
      <th class="text-center"> Stock</th>
      <th class="text-center">Date as of</th>
      <th class="text-center">Controls</th>
    </tr>
  </thead>
  <tbody>
    @foreach($stock as $s)
    <tr >

      <td class="text-center">
        {{ $s->MaterialName }}
      </td>
      <td class="text-center">
       {{$s->stocks}}
      </td>
      <td class="text-center">
        {{\Carbon\Carbon::parse($s->date_s)->toDayDateTimeString()}}
      </td>
      <td class="text-center">
         <button id="view" class="btn btn-info btn-alt view" value="{{$s->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Show Stock Card"> <span class="gi gi-folder_closed"> </span> </button>
        <button id="add" class="btn btn-success btn-alt add" value="{{$s->id}}" data-toggle="tooltip" data-placement="top" data-original-title="In"> <span class="gi gi-inbox_in"></span> </button>
        <button id="subtract" class="btn btn-danger btn-alt subtract" value="{{$s->id}}" data-toggle="tooltip" data-placement="top" data-original-title="Out"> <span class="gi gi-inbox_out"></span> </button>

    </td>
    
  </tr>
  @endforeach
  </tbody>

</table>
 <div id="show_stock_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
              <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;" id="name"></h3></div>
                
                   {{ Form::open(['target' => 's_blank','url'=>route('o.stockadjustment.printStockCard')]) }}
                     <div class="row">
                       <div class="col-md-9 col-md-offset-1">
                            <div class="form-group">
                              <div class="col-md-3">
                              <label class="control-label text-center">Select Date Range to Print</label> 
                            </div>
                                <div class="col-md-9">
                                   <div class="input-group" data-date-format="yyyy-mm-dd">
                                      <input type="date" id="datStart" name="datStart" class="form-control text-center " placeholder="From">
                                      <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                      <input type="date" id="datEnd" name="datEnd" class="form-control text-center " placeholder="Through">
                                  </div>
                               </div>
                              </div>
                            </div>
                       <div class="col-md-2">
                            <input type="hidden" name="myId" id="myId">
                          <button type="submit" id="submit"  class="btn btn-default" ><span class="gi gi-print"></span> Print</button>
                      </div>
                     </div>
                   {{ Form::close() }}  <hr>
          <table class="table table-vcenter table-striped table-borderless table-hover" style="font-family: 'Arial'">
            <thead>
              <tr>
                <th class="text-center col-md-2">DATE</th>
                <th class="text-center col-md-2">IN</th>
                <th class="text-center col-md-2">OUT</th>
                <th class="text-center col-md-2">BALANCE</th>
                <th class="text-center col-md-2">UNIT COST</th>
                <th class="text-center col-md-2">TOTAL COST</th>
                <th class="text-center col-md-2">SUPPLIER</th>
                <th class="text-center col-md-2">DELIVERY RECEIPT</th>
              </tr>
            </thead>
            <tbody id="area" class="text-center">
              
            </tbody>
          </table>
              
        </div>
      </div>
    </div> 
  </div>

      <div id="add_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
               <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;"><strong>Replenish Stocks</strong></h3>
                    </div>
               {!! Form::open(['url'=>route('stockadjustment.storeThis','classID'),'method'=>'POST','id'=>'frm-update']) !!}
               <input type="hidden" name="thisId" id="thisId" >
              <div class="form-group">
                  <label for="mats">Material Name</label>
                  {!! Form::text('matsname', null,  ['id'=>'matsname','class'=>'form-control', 'placeholder'=>'','readonly'=>'readonly']) !!}
              </div>
              <div class="form-group">
                  <label for="quantitys">Current Stocks </label>
                  {!!Form::text('quantitys',null,['id'=>'quantitys', 'class'=>'form-control','readonly'=>'readonly'])!!}
                </div>
              <div class="form-group">
                  <label for="qty">Quantity to be Added </label>
                  {!!Form::text('qty',null,['id'=>'qty', 'class'=>'form-control'])!!}
                  <script>
                      $('#qty').numeric({
                          decimalSeparator: ".",
                          maxDecimalPlaces : 2,
                          allowMinus:   false
                      });
                    </script>
                </div>
                <div class="form-group">
                            <label for="supp">Supplier <span class="text-danger">*</span>  </label>
                            {!! Form::select('supp', $supp, null,  ['id'=>'supp','class'=>'form-control', 'placeholder'=>' ','required'=>'required']) !!}
                          </div>
                          
                    <div class="form-group">
                          <label for="delrecs">Delivery Receipt Number <span class="text-danger">*</span> </label>
                          {!! Form::text('delrecs',null ,['id'=>'delrecs','placeholder'=>'', 'class' => 'form-control','required'=>'required']) !!}
                                         
                        </div>
                  <input type="hidden" id="mats" name="mats">
                  <input type="hidden" id="price_add" name="price_add">
                <hr>
                <div class="pull-right">
                <input type="hidden" name="myId" id="myId">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" id="add"  class="btn btn-primary" ><span class="gi gi-pen"></span> Save Changes</button>
              </div>
              {!!Form::close()!!}
        </div>
      </div>
    </div> 
  </div>

 <div id="sub_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
            <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;"><strong>Deplete Stocks</strong></h3>
                    </div>
               {!! Form::open(['url'=>route('stockadjustment.storeThat','classID'),'id'=>'frm-upd']) !!}
               <input type="hidden" name="thisIdd" id="thisIdd" >
              <div class="form-group">
                  <label for="mats">Material Name</label>
                  {!! Form::text('matdname',null,  ['id'=>'matdname','class'=>'form-control', 'placeholder'=>'','readonly'=>'readonly']) !!}
              </div>
              <div class="form-group">
                  <label for="quantitys">Current Stock </label>
                  {!!Form::text('quantityd',null,['id'=>'quantityd', 'class'=>'form-control','readonly'=>'readonly'])!!}
                </div>
              <div class="form-group">
                  <label for="qty">Quantity to be Reduced </label>
                  <input type="text" class="form-control" name="qtyd" id="qtyd" onkeyup="validate(this.value);">
                  <span id="duplicates3" class="help-block animation-slideDown">
                    Invalid Quantity
                    </span>
                  <script>

                      $('#qtyd').numeric({
                          decimalSeparator: ".",
                          maxDecimalPlaces : 2,
                          allowMinus:   false
                      });
                    </script>
                </div>
                  <input type="hidden" id="matd" name="matd">
                  <input type="hidden" id="price_sub" name="price_sub">

                <hr>
                <div class="pull-right">
                <input type="hidden" name="myIdd" id="myIdd">
                <button type="button" class="btn btn-warning " data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" class="btn btn-primary here" ><span class="gi gi-pen"></span> Save Changes</button>
              </div>
              {!!Form::close()!!}
        </div>
      </div>
    </div> 
  </div>





        
            <script>$(function(){ TablesDatatables.init(); });</script>