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
                                Dash<span class="opacity-75">mix</span>
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
                                    <i class="nav-main-link-icon fa fa-location-arrow"></i>
                                    <span class="nav-main-link-name">Dashboard</span>
                                    <span class="nav-main-link-badge badge badge-pill badge-success">5</span>
                                </a>
                            </li>
                            <li class="nav-main-heading">Various</li>
                            <li class="nav-main-item{{ request()->is('pages/*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                    <i class="nav-main-link-icon fa fa-lightbulb"></i>
                                    <span class="nav-main-link-name">Examples</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="/pages/datatables">
                                            <span class="nav-main-link-name">DataTables</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">
                                            <span class="nav-main-link-name">Slick Slider</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('pages/blank') ? ' active' : '' }}" href="/pages/blank">
                                            <span class="nav-main-link-name">Blank</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-main-heading">More</li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/">
                                    <i class="nav-main-link-icon fa fa-globe"></i>
                                    <span class="nav-main-link-name">Landing</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- END Sidebar Scrolling -->
            </nav>
