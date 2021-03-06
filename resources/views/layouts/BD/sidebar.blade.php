<ul class="sidebar-nav">
    <li>
        <a href="{{ route('bd.home') }}"><i class="gi gi-display sidebar-nav-icon"></i>Dashboard</a>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="fa fa-anchor"></i></a></span>
         <span class="sidebar-header-title">Default Settings</span>
     </li>
    <li >
        <a href="{{ route('bdutilities.index') }}"><i class="fa fa-cogs sidebar-nav-icon"></i>Utilities</a>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="gi gi-settings"></i></a></span>
         <span class="sidebar-header-title">Transaction</span>
     </li>
     
    <li >
        <a href="{{ route('billingcollection.index') }}"><i class="gi gi-sort sidebar-nav-icon"></i>Billing & Collection </a>
    </li>
    <!-- <li >
        <a href="{{ route('stock.index') }}"><i class="gi gi-cargo sidebar-nav-icon"></i>Stock Adjustment </a>
    </li> -->
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"></a></span>
         <span class="sidebar-header-title">Reports</span>
     </li> 
     
    <li >
        <a href="{{ route('soareports.index') }}"><i class="fa fa-file-pdf-o sidebar-nav-icon"></i>Statement of Accounts</a>
    </li>
    <li >
        <a  href="{{ route('references.index') }}"><i class="fa fa-file-pdf-o sidebar-nav-icon"></i>References of Billing</a>
    </li>
    <li >
        <a  href="{{ route('collectionreports.index') }}"><i class="fa fa-file-pdf-o sidebar-nav-icon"></i>Overall Collection</a>
    </li>
    
   <!--  <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="hi hi-list"></i></a></span>
         <span class="sidebar-header-title">Lists</span>
     </li>
    <li >
        <a href=""><i class="fa fa-cog sidebar-nav-icon"></i>Client List</a>
    </li> -->
    <!-- <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="hi hi-tasks"></i></a></span>
         <span class="sidebar-header-title">Queries & Reports</span>
     </li>
    <li>
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Statement of Accounts</a>
    </li>
     <li>
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>References of Billing</a>
    </li>
    <li>
       <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Overall Collection</a>
    </li> -->
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="fa fa-search"></i></a></span>
         <span class="sidebar-header-title">Queries</span>
     </li>
    <li >
        <a href="{{ route('invoicequeries.index')}}"><i class="fa fa-search sidebar-nav-icon"></i>Invoice</a>
    </li>
    <li >
        <a href="{{ route('orqueries.index')}}"><i class="fa fa-search sidebar-nav-icon"></i>Collection</a>
    </li>
</ul>