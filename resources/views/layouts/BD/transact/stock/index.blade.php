@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
  var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();

   function findSuppPrice(val)
  {
    
       /////////////////start top loading//////////
          NProgress.start();
          ///////////////////////////////////////////
          $('#matprices').val('');
          var matid= $('#thisId').val();

          var a4;
          $.get('getSuppPrice/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              if(data[a4].mat_id == matid)
              {
                $('#matprices').val(data[a4].MaterialUnitPrice);
              }
              // $('#symbols').val(data[a4].UOMUnitSymbol);

            }
          }
          /////////////////stop top loading//////////
          NProgress.done();
          ///////////////////////////////////////////
        })
  };
  // readByAjax();

</script>
@endsection
@section('sidebar')
  <!-- Main Sidebar -->
  <div id="sidebar">
      <!-- Wrapper for scrolling functionality -->
      <div class="sidebar-scroll">
          <!-- Sidebar Content -->
          <div class="sidebar-content">
              <!-- Icon for user -->
                @include('layouts.BD.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.BD.sidebar')
              <!-- END Sidebar Navigation -->
          </div>
          <!-- END Sidebar Content -->
      </div>
      <!-- END Wrapper for scrolling functionality -->
  </div>
  <!-- END Main Sidebar -->
@endsection

@section('content')
  <div class="content-header">
    <div class="header-section">
      <h4>
          <i class="gi gi-sort"> </i> Billing & Collection Transaction<br>
      </h4>
    </div>
  </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('bd.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Transaction</a></li>
        <li><a href="{{ route('billingcollection.index')}}">Billing & Collection</a></li>
        <li><a>Stock Adjustment</a></li>

    </ol>
       <div class="block full">
         <div class="block-title themed-background">
                            <h2 style="color:white"><strong>{{$task->ServTask}}</strong></h2>
                        </div>
                     <table class="table table-vcenter table-striped table-borderless table-hover" style="font-family: 'Arial'">
                        <thead>
                          <tr>
                            <th class="text-center">TASK</th>
                            <th class="text-center">MATERIALS</th>
                            <th class="text-center">QUANTITY NEEDED</th>
                            <th class="text-center">ESTIMATED COST</th>
                            <th class="text-center">STOCKS</th>
                            <th class="text-center">OVER OR (UNDER)</th>
                            <th class="text-center"></th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($stock as $stock)
                            <td> {{$stock->ServTask}}</td>
                            <td> {{$stock->MaterialName}}</td>
                            <td> {{$stock->quantity}} {{$stock->UOMUnitSymbol}}</td>
                            <td> {{$stock->mat_total}} </td>
                            <td> 
                              @if($stock->stocks==null)
                              <i>No Stocks</i>
                              @else
                              {{$stock->stocks}}

                              @endif
                            </td>
                            <td>
                             @if($stock->over==null && $stock->under ==null)
                              --
                              @elseif($stock->under==null)
                              {{$stock->over}}
                              @else
                              ({{$stock->under}})
                              @endif</td>
                            <td>
                              <button id="view" class="btn btn-info btn-alt view" value="{{$stock->mat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="Show Stock Card"> <span class="gi gi-folder_closed"> </span> </button>
                              <button id="add" class="btn btn-success btn-alt add" value="{{$stock->mat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="In"> <span class="gi gi-inbox_in"></span> </button>
                              <button id="subtract" class="btn btn-danger btn-alt subtract" value="{{$stock->mat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="Out"> <span class="gi gi-inbox_out"></span> </button> 
                            </td>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- END Working Tabs Block -->
         
      <div id="add_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
               <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;"><strong>Replenish Stocks</strong></h3>
                    </div>
               {!! Form::open(['url'=>route('stock.storeThis','classID'),'method'=>'POST','id'=>'frm-update']) !!}
                 <input type="hidden" name="thisId" id="thisId" >
                  <div class="form-group">
                      <h4 for="mats">Material Name: <b><span id="matsname_p"></span></b>  </h4>
                      <input type="hidden" id="matsname">
                      <!-- {!! Form::text('matsname', null,  ['id'=>'matsname','class'=>'form-control', 'placeholder'=>'','readonly'=>'readonly']) !!} -->
                  </div>
                   <div class="row">
                      <div class="col-md-6">
                        <h4 for="quantitys">Current Stocks: <b><span id="quantitys_p">0</span></b> </label>
                        <input type="hidden" id="quantitys">
                        <!-- {!!Form::text('quantitys',null,['id'=>'quantitys', 'class'=>'form-control','readonly'=>'readonly'])!!} -->
                      </div>
                    <div class="col-md-6">
                        <label for="qty">Quantity to be Added </label>
                        <input type="text" id="quant_add" name="quant_add" class="form-control">
                        <!-- {!!Form::text('quant_add',null,['id'=>'quant_add', 'class'=>'form-control'])!!} -->
                        <script>
                            $('#quant_add').numeric({
                                decimalSeparator: ".",
                                maxDecimalPlaces : 2,
                                allowMinus:   false
                            });
                          </script>
                      </div>
                   </div><br>
                   <div class="row">
                      <div class="col-md-4">
                            <label for="supplier">Supplier <span class="text-danger">*</span>  </label>
                            <select  id="supplier" class="form-control" onchange="findSuppPrice(this.value)">
                              <option value=""></option>
                            </select>
                          </div>
                      <div class="col-md-4">
                            <label for="supp">Price as Of <span id="pricedate"></span> <span class="text-danger">*</span>  </label>
                           {!! Form::text('matprices',null ,['id'=>'matprices','placeholder'=>'', 'class' => 'form-control','required'=>'required']) !!}
                      </div>
                    <div class="col-md-4">
                          <label for="delrecs">Delivery Receipt Number <span class="text-danger">*</span> </label>
                          {!! Form::text('delrecs',null ,['id'=>'delrecs','placeholder'=>'', 'class' => 'form-control','required'=>'required']) !!}
                                         
                        </div>
                   </div>
                  <input type="hidden" id="orig_price" name="orig_price">
                <hr>
                <div class="pull-right">
                <input type="hidden" name="myId" id="myId" value="{{$id}}">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="gi gi-remove_2"></span> Cancel</button>
                <button type="submit" id="add"  class="btn btn-primary" ><span class="gi gi-pen"></span> Save Changes</button>
              </div>
              {!!Form::close()!!}
        </div>
      </div>
    </div> 
  </div>

<!--  <div id="sub_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
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
  </div> -->



    

@endsection


@section('script')
  <script >
    // $(function(){ FormsValidation.init(); });
     $(document).ready(function(){
      var id='';
      var url = "stock";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var newSelect = document.getElementById("supplier");
            $('#supplier').empty();
            var option='';
            var i='';
            var a='';
       $(this).on('click','.add', function(){
            var classID = $(this).val();
            id = classID;
            
            $.get( classID + '/edit', function (data) {

                for( a=0;a<data.length;a++)
                {
                  $.get('getSupp/'+data[a].MatID,function(data){
                    for (i =0; i<data.length; i++) {
                       option = new Option(data[i].SuppDesc, data[i].id);
                        newSelect.appendChild(option);

                    }
                  })  
                  $('#thisId').val(data[a].MatID);
                  $('#quantitys').val(data[a].stocks);
                  if(data[a].stocks==null)
                  {
                  $('#quantitys_p').text('0');

                  }
                  else
                  {
                  $('#quantitys_p').text(data[a].stocks);
                    
                  }
                  $('#mats').val(data[a].MatID);
                  $('#matsname').val(data[a].MaterialName);
                  $('#matsname_p').text(data[a].MaterialName);
                  $('#pricedate').text(data[a].date);
                  $('#matprices').val(data[a].MaterialUnitPrice);
                  $('#orig_price').val(data[a].MaterialUnitPrice);
                  $('#overunder').val(data[a].overunder);
                  selfName = $('#quantitys').val();
                  className = $('#mats').val();
                }
                  $('#add_modal').modal('show');

              })

        });

      $('#frm-update').on('submit' ,function(e){
          // var formData = $('#frm-update').serialize();
          var formData ={
            thisId: id,
            quantitys: $('#quantitys').val(),
            quant_add: $('#quant_add').val(),
            matprices: $('#matprices').val(),
            delrecs: $('#delrecs').val(),
            orig_price: $('#orig_price').val(),
            myId: $('#myId').val()
          }
          console.log(formData);
          $.ajax({
            type : 'POST',
            url  : url,
            data : formData,
            dataType: 'json',
            success:function(data){
              console.log(data);
              window.location.reload();
              $(".modal").modal('hide');
              swal("Success","Stocks Updated!", "success");
            },
            error:function(data){

            }
          })
        }); 
    });
  </script>


@endsection