<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <title>
      @yield('title', 'Jomar Machine Shop and Engineering Services Management System (JMSESMS)')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link id="theme-link" rel="stylesheet" href="{{asset('css/themes/blue.css')}}">
    <link rel="stylesheet" href="{{asset('css/themes.css')}}">
    <script src="{{asset('dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('dist/sweetalert.css')}}">
    <script src="{{asset('js/vendor/modernizr.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery-latest.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.alphanum.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.mask.min.js')}}"></script>
    <style>
                  select:invalid { color: gray; }

            .label-container{
                  position:fixed;
                  bottom:48px;
                  right:105px;
                  display:table;
                  visibility: hidden;
            }
            .label-text{
                    color:#FFF;
                    background:rgba(51,51,51,0.5);
                    display:table-cell;
                    vertical-align:middle;
                    padding:10px;
                    border-radius:3px;
            }
            .label-arrow{
                    display:table-cell;
                    vertical-align:middle;
                    color:#577162;
                    opacity:0.5;
            }
            .float{
                    position:fixed;
                    width:60px;
                    height:60px;
                    bottom:40px;
                    right:40px;
                    background-color:#577162;
                    color:#FFFFFF;
                    border-radius:50px;
                    text-align:center;
                    box-shadow: 2px 2px 3px #999;
            }
            .my-float{
                    font-size:24px;
                    margin-top:18px;
            }
            a.float + div.label-container {
              visibility: hidden;
              opacity: 0;
              transition: visibility 0s, opacity 0.5s ease;
            }
            a.float:hover + div.label-container{
              visibility: visible;
              opacity: 1;
            }
    </style>
    @yield('head')
  </head>
  <body class="page-loading">
          <!-- Preloader -->
          <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
          <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in body element (HTML version) -->
          <div class="preloader themed-background">
              <h1 class="push-top-bottom text-light text-center"><strong>JMSESMS</strong></h1>
              <div class="inner">
                  <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                  <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
              </div>
          </div>
          <!-- END Preloader -->

          <!-- Page Container -->
          <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations footer-fixed">
              <!-- Alternative Sidebar -->
              <div id="sidebar-alt">
                  <!-- Wrapper for scrolling functionality -->
                  <div class="sidebar-scroll">
                      <!-- Sidebar Content -->
                      <div class="sidebar-content">
                          

                      
                      </div>
                      <!-- END Sidebar Content -->
                  </div>
                  <!-- END Wrapper for scrolling functionality -->
              </div>
              <!-- END Alternative Sidebar -->

               <!-- Main Sidebar -->
              @yield('sidebar')
              <!-- END Main Sidebar -->

              <!-- Main Container -->
              <div id="main-container">

                 <!-- Page content -->
                  <header class="navbar navbar-default">
                  <!-- Navbar Header -->
                    <div class="navbar-header">
                        <!-- Main Sidebar Toggle Button -->
                        <ul class="nav navbar-nav-custom">
                            <li>
                                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                                    <i class="fa fa-bars fa-fw"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- END Main Sidebar Toggle Button -->
                    </div>
                    <!-- END Navbar Header -->
                        <!-- Right Header Navigation -->
                        @include('layouts.utilities')
                        <!-- END Right Header Navigation -->
                  </header>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    @yield('content')
                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                @include('layouts.footers')
                <!-- END Footer -->
            </div>

            <!-- END Main Container -->
             
        </div>
        <!-- END Page Container -->
  <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
  @yield('addbtn')
   <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pages/formsGeneral.js') }}"></script>
    <script src="{{ asset('js/pages/formsValidation.js') }}"></script>
    <script src="{{ asset('js/pages/formsWizard.js') }}"></script>
    <script src="{{ asset('js/pages/tablesDatatables.js') }}"></script>
    <script src="{{ asset('js/pages/widgetsStats.js') }}"></script>
    @yield('script')
    </body>
</html>