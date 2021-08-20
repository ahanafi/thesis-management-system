            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div>
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                        <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div>
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">
                                    {{ showName(auth()->user()->full_name) }}
                                </span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                   User Options
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item" href="{{ auth()->user()->level === App\Models\User::LECTURER || auth()->user()->level === App\Models\User::STUDY_PROGRAM_LEADER ? route('lecturer.profile') : route('account.profile')}}">
                                        <i class="far fa-fw fa-user mr-1"></i>
                                        <span>Profil Akun</span>
                                    </a>
                                    <!-- Toggle Side Overlay -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <a class="dropdown-item" href="{{ route('account.change-password') }}">
                                        <i class="fa fa-fw fa-key mr-1"></i>
                                        <span>Ubah Password</span>
                                    </a>
                                    <!-- END Side Overlay -->

                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item bg-danger text-white" href="javascript:void(0)" onclick="confirmLogout()">
                                        <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="far fa-fw fa-list-alt"></i>
                        </button>
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary-darker">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
