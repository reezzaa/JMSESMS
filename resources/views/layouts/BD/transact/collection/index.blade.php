@extends('layouts.BD.transact.transact_main')
@section('head')
<script>
   var pathname = window.location.pathname;
  var lastPart = pathname.split("/").pop();


   function readByAjax()
  {
    
      $.ajax({
        type : 'get',
        url  : '/bd/readByAjax3/'+lastPart,
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
        <li><a>Collection</a></li>
    </ol>
       <div class="block full">
                        <!-- Working Tabs Title -->
                        <div class="block-title themed-background">
                            <h2 style="color:white"><strong>{{$coll->name}}</strong></h2>
                        </div>
                        <h4><b>List of Service Invoice</b></h4><br>
                       <div class="table-responsive">
                         
                       </div>

                    </div>
    <div id="show_modal" class="modal fade show_modal" tabindex="-1" role="dialog" aria-labelledby="EditSupplierModal" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="block">
             <div class="block-title themed-background">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn btn-default close" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <h3 class="themed-background" style="color:white;"><strong>Clearing</strong></h3>
              </div>

                <div class="form-group">
                     <table class="table">
                      <tr>
                        {!! Form::open(['url'=>'collection','method'=>'PUT','id'=>'frm-upd']) !!}
                         
                          <input type="hidden" id="or">
                          <button type="submit" class="btn btn-block btn-info">Clear</button>
                        {!!Form::close()!!}</tr>
                        <br>
                         <tr>
                        {!! Form::open(['url'=>'/bd/bouncePost','method'=>'POST','id'=>'frm-bnc','target'=>'_blank']) !!}
                          <a id="bounce" class="btn btn-block btn-default">Bounced Cheque</a>
                          <input type="hidden" id="b_or" name="b_or">

                            <div id="here">
                              <div class="block">
                                  <div class="row">
                                      <div class="form-group">
                                          <label for=""><h5><strong>Amount Due: <label id="due"></label></strong></h5></label>
                                      </div>
                                      <div class="form-group">
                                            <label for=""><h5><strong>New Cheque Number <span class="text-danger">*</span></strong></h5></label>
                                               <input type="text" id="cheque_no" name="cheque_no" maxlength="20" class="form-control col-md-8"> 
                                               <script>
                                                $('#cheque_no').alphanum({
                                                   allow :    '-/',
                                                 });
                                                  </script> 
                                      </div>
                                      <div class="form-group">
                                         <label for="" class="text-center"><h5><strong>Bank <span class="text-danger">*</span></strong></h5></label>
                                            <select name="bank" id="bank" class="form-control">
                                              @foreach($bank as $bank)
                                                <option value="{{$bank->id}}">{{$bank->BankName}}</option>
                                              @endforeach
                                            </select>  
                                      </div>
                                      <div class="col-md-offset-9">
                                        {!! Form::submit('Collect',['id'=>'submit','class'=>'btn btn-alt btn-success']) !!}
                                      </div>

                                  </div>
                              </div>
                            </div>
                        {!!Form::close()!!}
                        
                       </tr>
                     </table>
                          
                           
                      </div>
                    </div>
                <br>
                <div class="clearfix"></div>
          </div>
        </div>
      </div>
         
    

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
      $('#here').hide();
      $('.upd').on('click',function(){
        NProgress.start();
        var classID = $(this).val();
        $('#or').val(classID);
        $('#b_or').val(classID);
        $('#show_modal').modal('show');
        NProgress.done();
      });

      $(this).on('submit','#frm-upd',function(e){
           e.preventDefault();
              var formData =  
              {
                or: $('#or').val()
              }
              
              /////////////////start top loading//////////
              NProgress.start();
              ///////////////////////////////////////////
              $.ajax({
                type : 'put',
                url  : '/bd/collection/'+lastPart,
                data : formData,
                dataType: 'json',
                success:function(data){
                  readByAjax();
                    /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                  $(".modal").modal('hide');
                  // alert(data);
                  swal("Success","Updated Successfully!", "success");
                  window.open('/bd/printOR/'+$('#or').val());

                },
                error:function(data){
                  /////////////////stop top loading//////////
                NProgress.done();
                ///////////////////////////////////////////
                alert('error');
                 
                }
              })          
           e.stopPropagation();
      });
      
      $('#bounce').on('click',function(){
        var val = $('#b_or').val();
        NProgress.start();
        $.get('bouncePayment/' + val, function (data) {
          if(data.length != 0)
          {
            for(a4=0;a4<data.length;a4++)
            {
              $('#due').text(data[a4].amountpaid);
            }
          }
        })
        NProgress.done();

        $('#here').show();
      });
      $(document).on('hidden.bs.modal','#show_modal', function () 
         {
          $('#cheque_no').val('');
          $('#here').hide();
          $('#due').text('');
        });

      
    });
  </script>


@endsection