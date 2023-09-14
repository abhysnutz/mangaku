<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ route('console.comic.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.comic.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>Comic</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('console.chapter.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.chapter.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>Chapter</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('console.popular.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.popular.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-medal"></i>
                <p>Popular Comic</p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('console.grabber.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.grabber.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-hand-rock"></i>
                <p>Grabber</p>
            </a>
        </li> --}}

        <li class="nav-item">
            <a href="{{ route('console.queue.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.queue.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>Queue</p>
            </a>
        </li>

        <li class="nav-item {{ (Request::segment(2) == 'audit') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>Audit <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('console.audit.queue.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.audit.queue.index') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grabber Queue</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('console.audit.user.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.audit.user.index') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User Audit</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ (Request::segment(2) == 'setting') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('console.setting.password.index') }}" class="nav-link {{ (Route::currentRouteName() == 'console.setting.password.index') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-door-closed"></i>
                <p>Logout</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>