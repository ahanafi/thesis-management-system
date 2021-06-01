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
                            <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');" href="javascript:void(0)">
                                <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                            </a>
                            <!-- END Toggle Sidebar Style -->

                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
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
                                    <span class="nav-main-link-name">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-main-heading">MAIN MENU</li>
                            <li class="nav-main-item{{ request()->is('master/*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                    <i class="nav-main-link-icon fa fa-database"></i>
                                    <span class="nav-main-link-name">DATA MASTER</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('master/faculty') ? ' active' : '' }}" href="{{ route('faculty.index') }}">
                                            <i class="nav-main-link-icon fa fa-home"></i>
                                            <span class="nav-main-link-name">FAKULTAS</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('master/study-program') ? ' active' : '' }}" href="{{ route('study-program.index') }}">
                                            <i class="nav-main-link-icon fa fa-list-alt"></i>
                                            <span class="nav-main-link-name">PROGRAM STUDI</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">
                                            <i class="nav-main-link-icon fa fa-users"></i>
                                            <span class="nav-main-link-name">DOSEN</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">
                                            <i class="nav-main-link-icon fa fa-users"></i>
                                            <span class="nav-main-link-name">MAHASISWA</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">
                                            <i class="nav-main-link-icon fa fa-lightbulb"></i>
                                            <span class="nav-main-link-name">BIDANG ILMU</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-main-heading">PENGATURAN</li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('user.index') }}">
                                    <i class="nav-main-link-icon fa fa-users-cog"></i>
                                    <span class="nav-main-link-name">DATA PENGGUNA</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </nav>
