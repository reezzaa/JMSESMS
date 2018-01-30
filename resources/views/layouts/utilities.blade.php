<ul class="nav navbar-nav-custom pull-right">
    <!-- Alternative Sidebar Toggle Button -->
    <!--<li>
        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');">
            <i class="gi gi-share_alt"></i>
            <span class="label label-primary label-indicator animation-floating">4</span>
        </a>
    </li>
    -->
    <!-- END Alternative Sidebar Toggle Button -->

    <!-- User Dropdown -->
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
        </a>
        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
            <li class="dropdown-header text-center">Account</li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-envelope-o fa-fw pull-right"></i>
                    <span class="badge pull-right">5</span>
                    Messages
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="javascript:void(0)">
                    <i class="fa fa-user fa-fw pull-right"></i>
                    Account
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
            </li>
        </ul>
    </li>
    <!-- END User Dropdown -->
</ul>