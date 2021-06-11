<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="font-w600 text-white tracking-wide" href="/">
                <span class="smini-visible">
                    D<span class="opacity-75">x</span>
                </span>
                <span class="smini-hidden">
                    Thesis<span class="opacity-75">App</span>
                </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler"
                   data-class="fa-toggle-off fa-toggle-on"
                   onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');"
                   href="javascript:void(0)">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </a>
                <!-- END Toggle Sidebar Style -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                   href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
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
                    <a class="nav-main-link{{ request()->is('student/thesis-requirement') ? ' active' : '' }}" href="{{ route('student.thesis-requirement.index') }}">
                        <i class="nav-main-link-icon fa fa-file"></i>
                        <span class="nav-main-link-name">PERSYARATAN SKRIPSI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('student/thesis-submission') ? ' active' : '' }}" href="{{ route('student.thesis-submission.index') }}">
                        <i class="nav-main-link-icon fa fa-file-alt"></i>
                        <span class="nav-main-link-name">PROPOSAL SKRIPSI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="nav-main-link-icon fa fa-book"></i>
                        <span class="nav-main-link-name">DATA SKRIPSI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="nav-main-link-icon fa fa-reply-all"></i>
                        <span class="nav-main-link-name">BIMBINGAN SKRIPSI</span>
                    </a>
                </li>

                <!-- PENGUJIAN SKRIPSI -->
                <li class="nav-main-heading">PENGUJIAN SKRIPSI</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/faculty') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-building"></i>
                        <span class="nav-main-link-name">SEMINAR</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/study-program') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-people-carry"></i>
                        <span class="nav-main-link-name">SIDANG</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/lecturer') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-tools"></i>
                        <span class="nav-main-link-name">KOLOKIUM</span>
                    </a>
                </li>
                <!-- END PENGUJIAN SKRIPSI -->

                <!-- PENILAIAN -->
                <li class="nav-main-heading">PENILAIAN</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/faculty') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-building"></i>
                        <span class="nav-main-link-name">SEMINAR</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/study-program') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-people-carry"></i>
                        <span class="nav-main-link-name">SIDANG</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/lecturer') ? ' active' : '' }}"
                       href="#">
                        <i class="nav-main-link-icon fa fa-tools"></i>
                        <span class="nav-main-link-name">KOLOKIUM</span>
                    </a>
                </li>
                <!-- END PENILAIAN -->

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
    <!-- END Sidebar Scrolling -->
</nav>
