@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
  var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();


   function readByAjax()
  {
    
      $.ajax({
        type : 'get',
        url  : '/bd/readByAjax2/'+lastPart,
        dataType : 'html',
        success:function(data)
        { 
            $('.table-responsive').html(data);
              
        }
      })
  };
  readByAjax();
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
                                  <div class="btn-group col-md-offset-3">
                                     <button value="{{ $check->conid }}" id="process_bill" class="btn btn-info">Process Billing</button>
                                     <button value="{{ $check->conid }}" class="btn btn-default"><i class="fa fa-calendar-o"></i> Add Task </button>
                                     <button value="{{ $check->conid }}" class="btn btn-default"><i class="gi gi-cargo"></i> Adjust Stocks </button>
                                   </div>
                                </div>
                               </div> <br>
                               <div class="row">
                                   <p class="col-md-offset-2"><strong>Status: </strong> <label class="label label-success">Paid Downpayment</label></p>
                               </div>      
                                @endif
                                @endforeach
                               
                              <div class="table-responsive">                           
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

    // $('#bill').on('click',function(e){
    //   e.preventDefault();
    //   var ddata = {
    //     ContractID: lastPart,
    //     term: $('#term').val(),
    //     termdate: $('#termdate').val(),
    //     amount: $('#amount').val(),
    //     subtotal: $('#subtotal').val(),
    //     desc: $('#desc').val()
    //   }
    //   console.log(ddata);
    //     $.ajax({
    //             type : 'post',
    //             url  : '/bd/billing',
    //             data : ddata,
    //             dataType: 'json',
    //             success:function(data){
    //               $(function(){
    //             $.bootstrapGrowl('<h4>Success!</h4> ', {
    //               type: 'success',
    //               delay: '2500',
    //               allow_dismiss: true
    //             });
    //           });
               
    //           // window.location.reload();

    //             },
    //             error:function(data){
    //              $(function(){
    //             $.bootstrapGrowl('<h4>Cannot Save!</h4>', {
    //               type: 'success',
    //               delay: '2500',
    //               allow_dismiss: true
    //             });
    //           });
    //           // window.location.reload();
                   
    //             }
    //           })
    // });

    $('#print').on('submit',function(e){
      var classID = $(this).val();
      e.preventDefault();
     
    });
      
    });
  </script>


@endsection