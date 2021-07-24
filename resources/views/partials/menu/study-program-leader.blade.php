<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                    <i class="nav-main-link-icon fa fa-home"></i>
                    <span class="nav-main-link-name">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.thesis-submission.*') ? ' active' : '' }}"
                   href="{{ route('leader.thesis-submission.index') }}">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">PENGAJUAN SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.thesis.*') ? ' active' : '' }}"
                   href="{{ route('leader.thesis.index') }}">
                    <i class="nav-main-link-icon fa fa-book"></i>
                    <span class="nav-main-link-name">DATA SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('data-sets') ? ' active' : '' }}"
                   href="{{ route('leader.data-set.index') }}">
                    <i class="nav-main-link-icon fa fa-database"></i>
                    <span class="nav-main-link-name">DATA SET</span>
                </a>
            </li>

            <!-- PENENTUAN -->
            <li class="nav-main-heading">PENENTUAN</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.determination.supervisor.*') ? ' active' : '' }}"
                   href="{{ route('leader.determination.supervisor.index') }}">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">DOSEN PEMBIMBING</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('user/*') ? ' active' : '' }}"
                   href="{{ route('home') }}">
                    <i class="nav-main-link-icon fa fa-user-friends"></i>
                    <span class="nav-main-link-name">PENGUJI SEMINAR</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('user/*') ? ' active' : '' }}"
                   href="{{ route('home') }}">
                    <i class="nav-main-link-icon fa fa-users-cog"></i>
                    <span class="nav-main-link-name">PENGUJI SIDANG</span>
                </a>
            </li>
            <!-- END PENENTUAN -->
            <li class="nav-main-heading"></li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="#" onclick="confirmLogout()">
                    <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                    <span class="nav-main-link-name">LOGOUT</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</div>
