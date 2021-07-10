<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="font-w600 text-white tracking-wide" href="/">
                <img class="img-logo" src="{{ secure_asset('media/photos/ucic-yellow.png') }}" alt="TMS UCIC">
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
@if(auth()->user()->level === App\Models\User::ACADEMIC_STAFF)
    @include('partials.menu.academic-staff')
@elseif(auth()->user()->level === App\Models\User::STUDENT)
    @include('partials.menu.student')
@elseif(auth()->user()->level === App\Models\User::STUDY_PROGRAM_LEADER)
    @include('partials.menu.study-program-leader')
@elseif(auth()->user()->level === App\Models\User::LECTURER)
    @include('partials.menu.lecturer')
@endif
<!-- END Sidebar Scrolling -->
</nav>
