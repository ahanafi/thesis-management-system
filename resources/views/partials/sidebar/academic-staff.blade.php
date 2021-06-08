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
                <!-- DATA MASTER -->
                <li class="nav-main-heading">DATA MASTER</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/faculties') ? ' active' : '' }}"
                       href="{{ route('faculties.index') }}">
                        <i class="nav-main-link-icon fa fa-building"></i>
                        <span class="nav-main-link-name">FAKULTAS</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/study-programs') ? ' active' : '' }}"
                       href="{{ route('study-programs.index') }}">
                        <i class="nav-main-link-icon fa fa-list-alt"></i>
                        <span class="nav-main-link-name">PROGRAM STUDI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/lecturers') ? ' active' : '' }}"
                       href="{{ route('lecturers.index') }}">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">DOSEN</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/students/*') ? ' active' : '' }}"
                       href="{{ route('students.index') }}">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">MAHASISWA</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('master/science-fields/*') ? ' active' : '' }}"
                       href="{{ route('science-fields.index') }}">
                        <i class="nav-main-link-icon fa fa-lightbulb"></i>
                        <span class="nav-main-link-name">BIDANG ILMU</span>
                    </a>
                </li>
                <!-- END DATA MASTER -->

                <!-- DATA SKRIPSI -->
                <li class="nav-main-heading">DATA SKRIPSI</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('thesis-requirements') ? ' active' : '' }}"
                       href="{{ route('thesis-requirements.index') }}">
                        <i class="nav-main-link-icon fa fa-file-alt"></i>
                        <span class="nav-main-link-name">PERSYARATAN SKRIPSI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('users/*') ? ' active' : '' }}"
                       href="{{ route('users.index') }}">
                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                        <span class="nav-main-link-name">JADWAL UJIAN SKRIPSI</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('assessment-components') ? ' active' : '' }}"
                       href="{{ route('assessment-components.index') }}">
                        <i class="nav-main-link-icon fa fa-layer-group"></i>
                        <span class="nav-main-link-name">KOMPONEN NILAI</span>
                    </a>
                </li>
                <!-- END DATA SKRIPSI -->

                <!-- PENGATURAN -->
                <li class="nav-main-heading">PENGATURAN</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('users/*') ? ' active' : '' }}"
                       href="{{ route('users.index') }}">
                        <i class="nav-main-link-icon fa fa-users-cog"></i>
                        <span class="nav-main-link-name">DATA PENGGUNA</span>
                    </a>
                </li>
                <!-- END PENGATURAN -->
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>