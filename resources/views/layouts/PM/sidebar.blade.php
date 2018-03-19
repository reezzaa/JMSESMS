<ul class="sidebar-nav">
    <li>
        <a href="{{ route('pm.home') }}"><i class="gi gi-display sidebar-nav-icon"></i>Dashboard</a>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="fa fa-anchor"></i></a></span>
         <span class="sidebar-header-title">Default Settings</span>
     </li>
    <li >
        <a href="{{ route('pmutilities.index') }}"><i class="fa fa-cogs sidebar-nav-icon"></i>Utilities</a>
    </li>
    <li >
        <a href="{{ route('client.index') }}"><i class="gi gi-user sidebar-nav-icon"></i>Client</a>
    </li>
    
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="gi gi-settings"></i></a></span>
         <span class="sidebar-header-title">Transaction</span>
     </li>
    <li >
        <a  href="{{ route('contract.index') }}"><i class="hi hi-list sidebar-nav-icon"></i>Contract Management</a>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"></a></span>
         <span class="sidebar-header-title">Reports</span>
     </li> 
     
    <li >
        <a href="{{ route('progressreport.index') }}"><i class="fa fa-file-pdf-o sidebar-nav-icon"></i>Progress Report</a>
    </li>
    <li >
        <a href="{{ route('stockusagereport.index') }}"><i class="fa fa-file-pdf-o sidebar-nav-icon"></i>Stock Usage Report</a>
    </li>
    
   <!--  <li class="sidebar-header">
       <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="hi hi-list"></i></a></span>
        <span class="sidebar-header-title">Lists</span>
    </li>
   <li >
       <a href=""><i class="fa fa-cog sidebar-nav-icon"></i>Client List</a>
   </li> -->
   <!--  <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="hi hi-tasks"></i></a></span>
         <span class="sidebar-header-title">Queries & Reports</span>
     </li>
    <li >
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Progress Report</a>
    </li>
    <li >
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Status Report</a>
    </li> -->
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></span>
         <span class="sidebar-header-title">Queries</span>
     </li>
    <li >
        <a href="{{ route('contractqueries.index')}}"><i class="fa fa-search sidebar-nav-icon"></i>Contract</a>
    </li>
</ul>