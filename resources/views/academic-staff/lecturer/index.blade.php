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
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Data Dosen
        </h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-users"></i>
                    Data Dosen
                </h3>
                <div class="block-options">
                    <a href="{{ route('lecturers.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </a>
                    <a href="{{ route('lecturers.import') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-download"></i>
                        <span>Import Data</span>
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
                        <th>NIDN</th>
                        <th>Nama Lengkap</th>
                        <th class="d-none d-sm-table-cell">Homebase</th>
                        <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                        <th class="d-none d-sm-table-cell text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($lecturers as $lecturer)
                        <tr>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar7.jpg') }}" alt="">
                            </td>
                            <td class="font-w600">{{ $lecturer->nidn }}</td>
                            <td>
                                <a href="{{ route('lecturers.show', $lecturer->id) }}">{{ $lecturer->getNameWithDegree() }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $lecturer->study_program->name }}</td>
                            <td class="d-none d-sm-table-cell">
                                @if($lecturer->functional)
                                    <span class="badge badge-success">{{ getLecturship($lecturer->functional) }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip" title="Edit" data-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="Delete" data-original-title="Delete"
                                            onclick="confirmDelete('master/lecturers', '{{ $lecturer->id }}')"
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
