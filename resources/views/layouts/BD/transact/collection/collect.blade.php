@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
   var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();

  function cash()
  {
    NProgress.start();
    $.ajax({
        type : 'get',
        url  : 'byCash/'+ lastPart,
        dataType : 'html',
        success:function(data)
        { 
            $('.table-responsive').html(data);
            $('span#duplicatew').hide();
            $('#paymentcost').focus(function(){
              $('span#duplicatew').hide();
             });
           NProgress.done();
              
        }
      })
  }

function exact()
{
  $('span#duplicatew').hide();
  var dueamt = $('#due').text();
  $('#paymentcost').val(dueamt);
  $("#change").html("<br>₱ 0");
    $('#changed').val(0);
  


}
function compute()
{
  var dueamt = $('#due').text();
  var payment = $('#paymentcost').val();
    var ttotal = (payment - dueamt);
    var total = (Math.round((ttotal * 1000)/10)/100).toFixed(2);

  if(total<0)
  {
    $('span#duplicatew').show();
    $('#submit').attr('disabled',true);
    $("#change").html("");

  }
  else if (total>= 0)
  {
    $("#change").html("<br>₱ "+total);
    $('#changed').val(total);
    $('span#duplicatew').hide();
    $('#submit').attr('disabled',false);

  }
}   
  function cheque()
  {
    NProgress.start();
    $.ajax({
        type : 'get',
        url  : 'byCheque/'+ lastPart,
        dataType : 'html',
        success:function(data)
        { 
            $('.table-responsive').html(data);
           NProgress.done();
              
        }
      })
  }
  function formChange()
  {
    var form = $('#form').val();
    if( form==0)
    {
      cash();
    }
    else
    {
      cheque();
    }
  }
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
        <li><a href="{{ route('collection.show', $proc->ContractID)}}" >Collection</a></li>
        <li><a >Process Payment</a></li>
    </ol>
       <div class="block full">
                        <div class="block-title themed-background">
                            <h2 style="color:white"><strong>{{$proc->desc}}</strong></h2>
                        </div>
                       
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <div>
                              <label>Form of Payment</label>
                              <select id="form" onchange="formChange()" style="width: 250px;" class="form-control">
                                <option value="1">Cheque</option>
                                <option value="0">Cash</option>

                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="table-responsive col-md-offset-3">
                          
                        </div>
                    </div>
                    <!-- END Working Tabs Block -->
         
    

@endsection


@section('script')
  <script >
    // $(function(){ FormsValidation.init(); });
     $(document).ready(function(){
      var id='';
      var url = "collection";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
  cheque();

  $('#form-insert-cheque').on('submit',function(e){
    
  });
      
    });
  </script>


@endsection