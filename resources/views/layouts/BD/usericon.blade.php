<!-- Brand -->
<a href="{{ route('bd.home') }}" class="sidebar-brand">
    <i class="gi gi-flash"></i><strong>MSESMS</strong>
</a>
<!-- END Brand -->

<!-- User Info -->
<div class="sidebar-section sidebar-user clearfix">
    <div class="sidebar-user-avatar">
        <a href="javascript:void(0)">
            <img src="{{asset('img/mechanic.png')}}" alt="avatar">
        </a>
    </div>
    <div class="sidebar-user-name"><input type="hidden" id="userid" value="{{Auth::user()->id}}">Budget Department</div>
    <div class="sidebar-user-links">
   
        <a href="javascript:void(0)" data-toggle="tooltip" title="Profile"><i class="gi gi-user"></i></a>
        <a href="{{ route('logout') }}" data-toggle="tooltip" title="Logout"><i class="gi gi-exit"></i></a>
    </div>
</div>
<!-- END User Info -->

<!-- Theme Colors -->

<!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
