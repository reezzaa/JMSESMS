@extends('layouts.O.transact.transact_main')
@section('head')
<script>
   function readByAjax()
  {
      $.ajax({
        type : 'get',
        url  : "{{ url('o/readQueries') }}",
        dataType : 'html',
        success:function(data)
        {
            $('.table-responsive').html(data);
              $('[data-toggle="tooltip"]').tooltip();
              /////////////////stop top loading//////////
              NProgress.done();
              ///////////////////////////////////////////
        }
      })
  };
   function findMate(val)
      {
        $('#supplier').val('').trigger('chosen:updated');

        $('.table-responsive').html(" ");

         /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $.get('findMate/'+val, function (data) {
           $('.table-responsive').html(data);
           /////////////////stop top loading//////////
           NProgress.done();
          ///////////////////////////////////////////
        })

      }
      function findSupp(val)
      {
        $('#mat').val('').trigger('chosen:updated');

        $('.table-responsive').html(" ");

         /////////////////start top loading//////////
        NProgress.start();
        ///////////////////////////////////////////
        $.get('findSupp/'+val, function (data) {
           $('.table-responsive').html(data);
           /////////////////stop top loading//////////
           NProgress.done();
          ///////////////////////////////////////////
        })

      }
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
                @include('layouts.O.usericon')
              <!-- Sidebar Navigation -->
              @include('layouts.O.sidebar')
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
          <i class="fa fa-cubes"> </i> Stock Adjustment Transaction<br>
      </h4>
    </div>
  </div>
    <ol class="breadcrumb breadcrumb-top">
        <li><a href="{{ route('o.home') }}"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Transaction</a></li>
        <li><a href="javascript:void(0)">Stock Adjustment</a></li>
    </ol>
       
      <!-- Simple Profile Widgets Row -->
      
       <div class="block block-full">
             
                <br>
                    <div class="row">
                        <span class="fa fa-filter col-md-offset-1"> </span>  Filter by:
                        <br><br>
                        <div class="col-md-2">
                          <div class="form-group">
                            <div>
                              <label for="mat">Materials</label>
                              <select id="mat" name="mat" onchange="findMate(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Filter by Materials">
                                <option></option>
                                @foreach($getMat as $getMat)
                                <option value="{{$getMat->id}}">{{$getMat->MaterialName}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <div>
                              <label for="Status">Status</label>
                              <select id="Status" name="Status"  style="width: 250px;" class="select-chosen" data-placeholder="Filter by Status">
                                <option></option>
                                <option value="1">IN</option>
                                <option value="2">OUT</option>                             
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <div>
                              <label for="Status">Supplier</label>
                              <select id="supplier" name="supplier" onchange="findSupp(this.value)" style="width: 250px;" class="select-chosen" data-placeholder="Filter by supplier">
                                <option></option>
                              @foreach($getSupp as $getSupp)
                                <option value="{{$getSupp->id}}">{{$getSupp->SuppDesc}}</option>
                                @endforeach                    
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                              <div class="col-md-9">
                                <label for="">Date Range</label>
                                   <div class="input-group" data-date-format="yyyy-mm-dd">
                                      <input type="date" id="datStart" name="datStart" class="form-control text-center " placeholder="From">
                                      <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                      <input type="date" id="datEnd" name="datEnd" class="form-control text-center " placeholder="Through">
                                  </div>
                               </div>
                        </div>
                      </div>              
<br>                <div class="table-responsive">
                
                
              </div>
              <br>
            </div>
      
     
    

@endsection
@section('addbtn')
<a class="float"  data-toggle="tooltip" data-placement="left" title="Add Stocks">
    <i class="fa fa-plus my-float"></i></a>
@endsection

@section('script')
  <script >
    // $(function(){ FormsValidation.init(); });
     $(document).ready(function(){
      var id='';
      var url = "stockadjustment";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
    });
  </script>


@endsection