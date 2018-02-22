@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
  var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();

  //  function readByAjax()
  // {
    
  //     $.ajax({
  //       type : 'get',
  //       url  : '/bd/readByAjax2/'+lastPart,
  //       dataType : 'html',
  //       success:function(data)
  //       { 
  //           $('.table-responsive').html(data);
              
  //       }
  //     })
  // };
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
        <li><a>Billing</a></li>

    </ol>
       <div class="block full">
                      @foreach($contract as $check)

                        <!-- Working Tabs Title -->
                        <div class="block-title themed-background">
                            <h2 style="color:white"><strong>{{$check->name}} </strong></h2>
                        </div>        
                         @if($check->d_status==0)
                              <div class="row">
                                 <h4 class="col-md-6 col-md-offset-1" style="color: green"><strong>Overall Progress: </strong></h4>
                                <div class="col-md-5">
                                  <div class="btn-group col-md-offset-3">
                                     <button value="{{ $check->conid }}" id="process_bill" class="btn btn-info">Process Billing</button>
                                   </div>
                                </div>
                               </div> <br>
                               <div class="row">
                                   <p class="col-md-offset-2"><strong>Status: </strong> <label class="label label-danger">No Downpayment</label></p>
                                 </div>
                              @else
                                                    
                              <div class="row">
                                 <h4 class="col-md-6 col-md-offset-1" style="color: green"><strong>Overall Progress: {{$com}}%</strong></h4>
                                <div class="col-md-5">
                                  <div class="btn-group col-md-offset-2">
                                    @if($prog != null)
                                      @if($prog->Mode<= $com)
                                       <button value="{{ $check->conid }}" id="process_progbill" class="btn btn-info">Process Progress Billing</button>
                                       @else
                                       <button value="{{ $check->conid }}" id="process_progbill" class="btn btn-info" disabled="disabled">Process Progress Billing</button>
                                       @endif
                                     @else
                                       @if($count_incur == 0)
                                       <button value="{{ $check->conid }}" id="turnover" class="btn btn-info">Approve Project 
                                       Turnover</button>
                                       @else
                                       <button value="{{ $check->conid }}" id="turnover" disabled="disabled" class="btn btn-info">Approve Project 
                                       Turnover</button>
                                       @endif
                                     @endif
                                     @if($count_incur == 0)
                                     <button value="{{ $check->conid }}" id="process_incbill" disabled="disabled" class="btn btn-default">Process Incurrences Billing</button>
                                     @else
                                     <button value="{{ $check->conid }}" id="process_incbill" class="btn btn-default">Process Incurrences Billing</button>
                                     @endif
                                    
                                   </div>
                                </div>
                               </div> <br>
                               <div class="row">
                                   <p class="col-md-offset-1"><strong>Status: </strong> <label class="label label-success">Paid Downpayment</label>&nbsp;
                                    @foreach($getpaidpb as $ppb)<label class="label label-success">Paid {{$ppb->Mode}}% Progress Bill</label>&nbsp;@endforeach
                                    @if($prog == null)
                                    <span></span>
                                    @else      
                                    <strong> &nbsp; Next Progress Billing at: </strong> {{$prog->Mode}} %</p> 
                                    @endif
                               </div>      
                                @endif
                                @endforeach
                               
                              <div class="row">
                                <div class="table-responsive col-md-10">    
                                @include('layouts.BD.transact.billing.table')
                          </div>
                          <div class="col-md-2 pull-left"> 
                            <br><br><br>
                            @foreach($tasktable as $ta)
                            <div class="btn-group">
                                        <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-alt btn-default dropdown-toggle"> Actions <span class="caret"></span></a>
                                        <ul class="dropdown-menu dropdown-custom text-left">
                                            <li>
                                                <a><i class="gi gi-eye_open"></i> View</a>
                                                
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a> Skill</a>
                                                <a >Material</a>
                                                <a >Equipment</a>
                                                <a >Fees & Expenses</a>

                                            </li>
                                             <li class="divider"></li>
                                            <li>
                                                <a  href="/bd/stock/{{$ta->task_id}}" id="stock"> Adjust Stocks</a>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                            @endforeach
                          </div>
                            </div>
                    </div>
                    <!-- END Working Tabs Block -->
         
 <div id="show_stock_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
              <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;" id="name"></h3></div>
                
                   {{ Form::open(['method' => 'POST','url'=>'/bd/billing','id'=>'frm-insert','target'=>'_blank']) }}
                    @include('layouts.BD.transact.billing.current')
                    <input type="hidden" name="ContractID" value="{{$id}}">
                   {{ Form::close() }}     
                    

        </div>
      </div>
    </div> 
  </div>

  <div id="show_progbill_modal" class="modal fade edit-employee-modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="block full container-fluid">
              <div class="block-title themed-background">
              <div class="block-options pull-right">
                          <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                      </div>
                      <h3 class="themed-background" style="color:white;" id="name"></h3></div>
                
                   {{ Form::open(['method' => 'POST','url'=>'/bd/billing','id'=>'frm-insert','target'=>'_blank']) }}
                    @if($prog==null)
                    <span></span>
                    @else
                    @include('layouts.BD.transact.billing.progress')
                    @endif
                    <input type="hidden" name="ContractID" value="{{$id}}">
                   {{ Form::close() }}     
                    

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
      var url = "billing";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $(this).on('click','#process_bill',function(){
      NProgress.start();
            $('#show_stock_modal').modal('show');
       /////////////////stop top loading//////////
              NProgress.done();
        ///////////////////////////////////////////
    });

    $(this).on('click','#process_progbill',function(){
      NProgress.start();
            $('#show_progbill_modal').modal('show');
       /////////////////stop top loading//////////
              NProgress.done();
        ///////////////////////////////////////////
    });

    // $(this).on('click','#stock',function(){
    //   var classID = $(this).val();

    //   NProgress.start();

    //        window.location='/bd/stock/'+classID;
    //    /////////////////stop top loading//////////
    //           NProgress.done();
    //     ///////////////////////////////////////////
    // });

  
    $('#print').on('submit',function(e){
      var classID = $(this).val();
      e.preventDefault();
     
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

     //  var checkbox = document.querySelector('#checkall');
     // checkbox.addEventListener('change',function(){
     //    document.getElementsByClassName('.check') = checkbox.checked ? this.attr('checked',true):this.attr('checked',false);
     // });
    

    });
  </script>


@endsection