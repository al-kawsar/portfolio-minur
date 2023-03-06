@auth
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html">MINUR TECH</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="index.html"></a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Portofolio</li>
                <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::route('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>

                {{-- @if (Auth::user()->role === '2') --}}
                <li class="nav-item dropdown {{ $type_menu === 'admins' ? 'active' : '' }}">
                    <a href="{{ route('admins') }}" class="nav-link {{ Request::route('admins') ? 'active' : '' }}"><i
                            class="fa-solid fa-users"></i><span>Admins</span></a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'sliders' ? 'active' : '' }}">
                    <a href="{{ route('sliders') }}" class="nav-link {{ Request::route('sliders') ? 'active' : '' }}"><i
                            class="fas fa-th"></i><span>Sliders</span></a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'profiles' ? 'active' : '' }}">
                    <a href="{{ route('profiles') }}" class="nav-link {{ Request::route('profiles') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-card"></i>
                        <span>Profile</span></a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'skills' ? 'active' : '' }}">
                    <a href="{{ route('skills') }}" class="nav-link {{ Request::route('skills') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-card"></i>
                        <span>Skills</span></a>
                </li>
                <li class="nav-item dropdown {{ $type_menu === 'projects' ? 'active' : '' }}">
                    <a href="{{ route('projects') }}" class="nav-link {{ Request::route('projects') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-card"></i>
                        <span>Projects</span></a>
                </li>

            </ul>

            {{-- <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div> --}}
        </aside>
    </div>
@endauth
