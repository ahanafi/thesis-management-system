<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>TMS - Thesis Management System</title>

    <meta name="description" content="TMS - Thesis Management Information System at CIC University">
    <meta name="author" content="Ahmad Hanafi">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ mix('css/dashmix.css') }}">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
</head>
<body>
<!-- Page Container -->
<div id="page-container" class="page-header-dark main-content-boxed side-trans-enabled">

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <a class="font-w600 text-dual tracking-wide" href="{{ route('/') }}">
                    Thesis <span class="opacity-75">Management</span>
                    <span class="font-w400">System</span>
                </a>
                <!-- END Logo -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div>
                <!-- Open Search Section -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a href="{{ route('login') }}" class="btn bg-white text-primary btn-dual ml-2" data-toggle="layout"
                   data-action="header_search_on">
                    <span>Login Now</span>
                    <i class="fa fa-fw fa-arrow-right"></i>
                </a>
                <!-- END Open Search Section -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Navigation -->
        <div class="bg-white">
            <div class="content">
                <!-- Toggle Main Navigation -->
                <div class="d-lg-none push">
                    <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                    <button type="button"
                            class="btn btn-block btn-light d-flex justify-content-between align-items-center"
                            data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                        Menu
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- END Toggle Main Navigation -->

                <!-- Main Navigation -->
                <div id="main-navigation" class="d-none d-lg-block push">
                    <ul class="nav-main nav-main-horizontal nav-main-hover">
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="#student-accounts">
                                <i class="nav-main-link-icon fa fa-user-friends"></i>
                                <span class="nav-main-link-name">Student</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#lecturer-accounts">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Lecturer</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#head-of-study-program-accounts">
                                <i class="nav-main-link-icon fa fa-user-friends"></i>
                                <span class="nav-main-link-name">Head of Study Program</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#academic-staff-accounts">
                                <i class="nav-main-link-icon fa fa-user-friends"></i>
                                <span class="nav-main-link-name">Academic Staff</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Main Navigation -->
            </div>
        </div>
        <!-- END Navigation -->
        <!-- Page Content -->
        <div class="content">
            <!-- Users and Purchases -->
            <div class="row row-deck">
                <div class="col-xl-12" id="student-accounts">
                    <!-- Students -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                Student Accounts
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-hover table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->level === App\Models\User::STUDENT)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ showName($user->full_name) }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-fw fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Students -->
                </div>

                <div class="col-xl-12" id="lecturer-accounts">
                    <!-- Lecturers -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                Lecturer Accounts
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-hover table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th>#</th>
                                    <th>Lecturer Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($number = 1)
                                @foreach($users as $user)
                                    @if($user->level === App\Models\User::LECTURER)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ showName($user->full_name) }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-fw fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Lecturers -->
                </div>

                <div class="col-xl-12" id="head-of-study-program-accounts">
                    <!-- Leaders -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                Head of Study Program Accounts
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-hover table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th>#</th>
                                    <th>Lecturer Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($number = 1)
                                @foreach($users as $user)
                                    @if($user->level === App\Models\User::STUDY_PROGRAM_LEADER)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ showName($user->full_name) }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-fw fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Leaders -->
                </div>

                <div class="col-xl-12" id="academic-staff-accounts">
                    <!-- Academic Staff -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                Academic Staff Accounts
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-hover table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($number = 1)
                                @foreach($users as $user)
                                    @if($user->level === App\Models\User::ACADEMIC_STAFF)
                                        <tr>
                                            <td>{{ $number++ }}</td>
                                            <td>{{ showName($user->full_name) }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>123456</td>
                                            <td class="text-center">
                                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-fw fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Academic Staff -->
                </div>
            </div>
            <!-- END Users and Purchases -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
@include('partials.footer')
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Dashmix Core JS -->
<script src="{{ mix('/js/dashmix.app.js') }}"></script>

<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

</body>
</html>
