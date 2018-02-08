<ul class="sidebar-nav">
    <li>
        <a href="{{ route('o.home') }}"><i class="gi gi-display sidebar-nav-icon"></i>Dashboard</a>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Quick Settings"><i class="fa fa-anchor"></i></a></span>
         <span class="sidebar-header-title">Default Settings</span>
     </li>
    <li >
        <a href="{{ route('utilities.index') }}"><i class="fa fa-cogs sidebar-nav-icon"></i>Utilities</a>
    </li>
    <li>
        <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i>
        <i class="gi gi-adjust_alt sidebar-nav-icon"></i>Maintenance</a>
        <ul>
            <li>
                <a href="{{ route('skill.index') }}"><i class="fa fa-lightbulb-o sidebar-nav-icon"></i>Skills</a>
            </li>
            <li>
              <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i>
              <i class="fa fa-tachometer sidebar-nav-icon"></i>Unit of Measurement</a>
              <ul>
                  <li>
                      <a href="{{ route('dimension.index') }}">Dimension</a>
                  </li>
                  <li>
                      <a href="{{ route('detailuomeasure.index') }}">Detail UOM</a>
                  </li>
              </ul>
            </li>
            <li>
                <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i>
                <i class="fa fa-cubes sidebar-nav-icon"></i>Material</a>
                <ul>
                    <li>
                        <a href="{{ route('materialtype.index') }}">Material Type</a>
                    </li>
                    <li>
                        <a href="{{ route('materialclass.index') }}">Material Classification</a>
                    </li>
                    <li>
                        <a href="{{ route('material.index') }}">Material</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('equipment.index') }}"><i class="gi gi-blacksmith sidebar-nav-icon"></i>Equipment</a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}"><i class="fa fa-stack-overflow sidebar-nav-icon"></i>Supplier</a>
            </li>
            <li>
                <a href="{{ route('bank.index') }}"><i class="fa fa-institution sidebar-nav-icon"></i>Bank</a>
            </li>
            <!-- <li>
                <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Price Adjustment</a>
            </li> -->
            <li>
                <a href="{{ route('serviceOff.index') }}"><i class="gi gi-hand_saw sidebar-nav-icon"></i>Services Offered</a>
            </li>
            <li>
                <a href="{{ route('task.index') }}"><i class="fa fa-calendar-o sidebar-nav-icon"></i>Tasks</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="gi gi-settings"></i></a></span>
         <span class="sidebar-header-title">Transaction</span>
     </li>
    <li >
        <a href="{{ route('stockadjustment.index') }}"><i class="fa fa-cubes sidebar-nav-icon"></i>Stock Adjustment </a>
    </li>
     <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"></a></span>
         <span class="sidebar-header-title">Queries & Reports</span>
     </li>
    <li >
        <a href="{{ route('o.stockadjustment.queries') }}"><i class="fa fa-search sidebar-nav-icon"></i>Stocks </a>
    </li>
    <!-- <li>
                <a href="#" class="sidebar-nav-submenu"><i class="fa fa-angle-left sidebar-nav-indicator"></i>
                <i class="gi gi-user sidebar-nav-icon"></i>Client</a>
                <ul>
                    <li>
                        <a href="#" ><i class="fa fa-angle-left sidebar-nav-icon"></i>List of Clients</a>
                    </li>
                </ul>
            </li> -->
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
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Material</a>
    </li>
    <li>
        <a href=""><i class="fa fa-files-o sidebar-nav-icon"></i>Equipment</i></a>
    </li> -->
    <li class="sidebar-header">
        <span class="sidebar-header-options clearfix"><a href="javascript:void(0)"><i class="fa fa-child"></i></a></span>
         <span class="sidebar-header-title">User Account</span>
     </li>
    <li >
        <a href=""><i class="fa fa-cog sidebar-nav-icon"></i>Manage Accounts</a>
    </li>
</ul>