@extends('layouts.BD.transact.transact_main')
@section('head')

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
                        <!-- Working Tabs Title -->
                        <div class="block-title themed-background">
                            <h2 style="color:white"><strong>Contract No. </strong></h2>
                        </div>
                        <!-- END Working Tabs Title -->

                        <!-- Working Tabs Content -->
                              <h5><strong>Client: </strong>Sample</h5>
                              <br>
                           
                                <ul class="nav nav-tabs push" data-toggle="tabs">
                                    <li class="active"><a href="#tabs-billing">For billing</a></li>
                                    <li><a href="#tabs-collection">Project Status Overview</a></li>
                                    <li><a href="#tabs-incurrences">Refrences of Billing</a></li>

                                  <!--   <li><a href="#tabs-messages" data-toggle="tooltip" title="Messages"><i class="fa fa-envelope-o"></i></a></li>
                                    <li><a href="#tabs-settings" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a></li> -->
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-billing">
        
                                    </div>
                                    <div class="tab-pane" id="tabs-collection">
                                      @include('layouts.BD.transact.billing.overview')
                                    </div>
                                    <div class="tab-pane" id="tabs-incurrences">
                                      @include('layouts.BD.transact.billing.references')

                                    </div>
                                  <!--   <div class="tab-pane" id="example-tabs-messages">Messages..</div>
                                    <div class="tab-pane" id="example-tabs-settings">Settings..</div> -->
                                </div>
                                <!-- END Default Tabs -->
                    </div>
                    <!-- END Working Tabs Block -->
         
    

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
 
      
    });
  </script>


@endsection