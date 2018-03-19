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
          <i class="gi gi-sort"> </i> Stock Adjustment Transaction<br>
      </h4>
    </div>
  </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('bd.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Transaction</a></li>
        <li><a href="{{ route('stock.index')}}">Stock Adjustment</a></li>
        <li><a>{{$id}}</a></li>

    </ol>
       <div class="block full">
         <div class="block-title themed-background">
                        </div>
                        <div class="btn-group col-md-offset-10">
                                     <button value="" id="process_bill" class="btn btn-default">Add Billing</button>
                                   </div><br>
                     <table class="table table-vcenter table-striped table-borderless table-hover" style="font-family: 'Arial'">
                        <thead>
                          <tr>
                            <th class="text-center"><input type="checkbox" id="checkall"></th>
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
                            <tr>
                              <td>
                              @if($stock->over==null && $stock->under ==null)
                              <span></span>
                              @else
                              <input type="checkbox" class="check" name="check[]" id="check" >
                              @endif
                                </td>
                            <td> {{$stock->MaterialName}}</td>
                            <td> {{$stock->quantity}}</td>
                            <td> {{$stock->total}}</td>
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
                              <button id="view" class="btn btn-info btn-alt view" value="{{$stock->smat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="Show Stock Card"> <span class="gi gi-folder_closed"> </span> </button>
                              <button id="add" class="btn btn-success btn-alt add" value="{{$stock->smat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="In"> <span class="gi gi-inbox_in"></span> </button>
                              <button id="subtract" class="btn btn-danger btn-alt subtract" value="{{$stock->smat_id}}" data-toggle="tooltip" data-placement="top" data-original-title="Out"> <span class="gi gi-inbox_out"></span> </button> 
                            </td>
                          </tr>
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
               {!! Form::open(['url'=>'/bd/stock','method'=>'POST','id'=>'frm-update']) !!}
                 <input type="hidden" name="thisId" id="thisId" >
                  <div class="form-group">
                      <h4 for="mats">Material Name: <b><span id="matsname_p"></span></b>  </h4>
                      <input type="hidden" id="matsname">
                      <!-- {!! Form::text('matsname', null,  ['id'=>'matsname','class'=>'form-control', 'placeholder'=>'','readonly'=>'readonly']) !!} -->
                  </div>
                   <div class="row">
                      <div class="col-md-6">
                        <h4 for="quantitys">Current Stocks: <b><span id="quantitys_p">0</span></b> </label>
                        <input type="hidden" id="quantitys" name="quantitys">
                        <input type="hidden" id="totcost" name="totcost">
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
                            <label for="supplier">Supplier   </label>
                            <h4 id="supplier"></h4>
                            <!-- <select  id="supplier" class="form-control" onchange="findSuppPrice(this.value)">
                              <option value=""></option>
                              @foreach($supp as $supp)
                              <option value="{{$supp->id}}">{{$supp->SuppDesc}}</option>
                              @endforeach
                            </select> -->
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
<div id="show_stock_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
              <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;"><b>View StockCard</b></h3></div>
                
                 
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

       $(this).on('click','#subtract',function(){
        $('#sub_modal').modal('show');
      });
      var newSelect = document.getElementById("supplier");
            // $('#supplier').empty();
            var option='';
            var i='';
            var a='';
       $(this).on('click','.add', function(){
            var classID = $(this).val();
            id = classID;
            
            $.get( classID + '/edit', function (data) {

                for( a=0;a<data.length;a++)
                {
                  // $.get('getSupp',function(data){
                  //   for (i =0; i<data.length; i++) {
                  //      option = new Option(data[i].SuppDesc, data[i].id);
                  //       newSelect.appendChild(option);

                  //   }
                  // })  
                  $('#thisId').val(data[a].ServMatID);
                  if(data[a].stocks==null)
                  {
                  $('#quantitys_p').text('0');
                  $('#quantitys').val(0);

                  }
                  else
                  {
                  $('#quantitys').val(data[a].stocks);
                  $('#quantitys_p').text(data[a].stocks);
                    
                  }
                  $('#mats').val(data[a].MatID);
                  $('#matsname').val(data[a].MaterialName);
                  $('#matsname_p').text(data[a].MaterialName);
                  $('#supplier').text(data[a].SuppDesc);
                  $('#pricedate').text(data[a].date);
                  $('#matprices').val(data[a].MaterialUnitPrice);
                  $('#totcost').val(data[a].totalcost);
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
          // alert($('#quantitys').val());
          var formData ={
            thisId: $('#thisId').val(),
            quantitys: $('#quantitys').val(),
            quant_add: $('#quant_add').val(),
            matprices: $('#matprices').val(),
            delrecs: $('#delrecs').val(),
            orig_price: $('#orig_price').val(),
            totcost: $('#totcost').val(),
            myId: $('#myId').val()
          }

          console.log(formData);
          $.ajax({
            type : 'POST',
            url  : '/bd/stock',
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
      $(this).on('click','#view',function(){
           var classID = $(this).val();
          var a,b=0;
          $('#myId').val(classID);

         /////////////////top loading//////////
          NProgress.start();
          /////////////////////////////////////
          $.ajax({
          type : 'get',
          url  : '/bd/stock/openStock/'+classID,
          dataType: 'json',
          success:function(data){
            
             for(a=0;a<data.length;a++)
            {
              if(data[a].method == 'IN')
              {
                document.getElementById("area").innerHTML += '<tr><td>'+data[a].date+'</td><td>'+data[a].quantity+' '+data[a].UOMUnitSymbol+'</td><td></td><td>'+data[a].stock+' '+data[a].UOMUnitSymbol+'</td><td> ₱ '+data[a].cost+'</td><td> ₱ '+data[a].totalcost+'</td><td>'+data[a].SuppDesc+'</td><td> '+data[a].number+'</td></tr>';

              }
              else
              {
                document.getElementById("area").innerHTML += '<tr><td>'+data[a].date+'</td><td></td><td>'+data[a].quantity+' '+data[a].UOMUnitSymbol+'</td><td>'+data[a].stock+' '+data[a].UOMUnitSymbol+'</td><td> ₱ '+data[a].cost+'</td><td> ₱ '+data[a].totalcost+'</td><td> </td><td> </td></tr>';
              }
            }
            $('#show_stock_modal').modal('show');
          }
          });

           /////////////////stop top loading//////////
            NProgress.done();
            ///////////////////////////////////////////
          $('#area').empty();


        });

      //select all checkboxes
      $("#checkall").change(function(){  //"select all" change 
          $(".check").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
      });

      //".checkbox" change 
      $('.check').change(function(){ 
          //uncheck "select all", if one of the listed checkbox item is unchecked
          if(false == $(this).prop("checked")){ //if this item is unchecked
              $("#checkall").prop('checked', false); //change "select all" checked status to false
          }
          //check "select all" if all checkbox items are checked
          if ($('.check:checked').length == $('.check').length ){
              $("#checkall").prop('checked', true);
          }
      });

    });
  </script>


@endsection