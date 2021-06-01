@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Mahasiswa</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item active" aria-current="page">Plugin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Data Mahasiswa</h3>
                <div class="block-options">
                    <a href="{{ route('student.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">
                            <i class="fa fa-user"></i>
                        </th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell">Program Studi</th>
                        <th class="d-none d-sm-table-cell text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($index = 1)
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar7.jpg') }}" alt="">
                            </td>
                            <td class="font-w600">{{ $student->nim }}</td>
                            <td class="text-center">{{ $student->full_name }}</td>
                            <td class="d-none d-sm-table-cell">{{ $student->email }}</td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-success">{{ $student->study_program_code }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip" title="Edit" data-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="Delete" data-original-title="Delete"
                                            onclick="confirmDelete('master/student', '{{ $student->id }}')"
                                    >
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
