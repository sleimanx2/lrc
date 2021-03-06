<header class="clearfix">
    <div class="top-nav">
        <ul class="nav-left list-unstyled">
            <!-- <li> -->
                <!-- needs to be put after logo to make it working-->
                <!-- <div class="menu-button" toggle-off-canvas>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>

            </li>
            <li>
                <a href="#/" data-toggle-min-nav
                   class="toggle-min"
                        ><i class="fa fa-bars"></i></a>
            </li> -->
            <li class="app-logo">
                <i class="fa fa-plus"></i><span>LRC<b>204</b></span>
            </li>
            <li class="app-nav {{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home-dashboard') }}">Dashboard</a></li>
            <!-- <li class="app-nav {{ Request::is('emergencies*') ? 'active' : '' }}"><a href="{{ route('emergencies-list') }}">Emergencies</a></li> -->
            <!-- <li class="app-nav {{ Request::is('missions*') ? 'active' : '' }}"><a href="">Missions</a></li> -->
            <li class="dropdown app-nav {{ Request::is('blood*') ? 'active' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Blood</a>

                <ul class="dropdown-menu">
                    <li><a href="{{ route('blood-requests-list') }}">Blood Requests</a></li>
                    <li><a href="{{ route('blood-donors-list') }}">Blood Donors</a></li>
                </ul>
            </li>
            @if(auth()->user()->can_access_admin)
            <li class="dropdown app-nav {{ (Request::is('users*') || Request::is('contacts*')) ? 'active' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Admin</a>

                <ul class="dropdown-menu">
                    <li><a href="{{ route('users-list') }}">Manage Users</a></li>
                    <li><a href="{{ route('contacts-list') }}">Manage Contacts</a></li>
                </ul>
            </li>
            @endif
            <!-- <li class="app-nav {{ Request::is('borrowings*') ? 'active' : '' }}"><a href="">Borrowings</a></li> -->
            <!-- <li class="app-nav {{ Request::is('sad*') ? 'active' : '' }}"><a href="">SAD</a></li> -->
        </ul>

        <ul class="nav-right pull-right list-unstyled">
            <!-- <li><a href="javascript:void(0)" class="btn btn-header red" data-toggle="modal" data-target="#modalAddEmergency"><i class="fa fa-ambulance"></i></a></li> -->
            <li><button class="btn btn-header red" data-toggle="modal" data-target="#modalAddBloodRequest"><i class="fa fa-tint"></i></button></li>
            <li><button class="btn btn-header light" onclick="showPhonebookSidebar()"><i class="fa fa-phone"></i></button></li>
            <li class="dropdown">
                <button class="dropdown-toggle btn btn-header light" style="width: auto" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="text-small m-l-sm" style="vertical-align: top">{{ Auth::user()->full_name }}</span></button>
                
                <ul class="dropdown-menu flipped">
                    <li>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalChangeUserPassword">Change Password</a>
                    </li>
                    <li class="seperator"></li>
                    <li>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>