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
    <script>
        jQuery(function () {
            const lecturerData = $("#lecturer-data").DataTable({
                ajax: {
                    url: "{{ route('api.lecturers.data') }}",
                    data: function (d) {
                        d.filterHomebase = $('#filter-homebase').val();
                        d.filterLecturship = $("#filter-lecturship").val();
                    }
                },
                serverSide: true,
                processing: true,
                iDisplayLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                columns: [
                    {
                        data: 'id',
                        name: "No.",
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'nidn'},
                    {data: 'full_name'},
                    {
                        data: 'homebase',
                        searchable: false,
                    },
                    {data: 'functional'},
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            let filterByStudyProgram = `<select id='filter-homebase' class='ml-4 form-control form-control-sm'><option value='all'>-- Semua Program Studi --</option>`;
            @foreach($studyPrograms as $studyProgram)
                filterByStudyProgram += `<option value='{{ $studyProgram->study_program_code }}'>{{ $studyProgram->name }}</option>`;
            @endforeach
                filterByStudyProgram += `</select>`;

            let filterByLecturship = `<select id='filter-lecturship' class='form-control form-control-sm w-auto d-inline mr-4'><option value='all'>-- Semua Jab. Fungsional --</option>`;
            @foreach(getLecturship() as $key => $name)
                filterByLecturship += `<option value='{{ $key }}'>{{ $name }}</option>`;
            @endforeach
                filterByLecturship += `<option value='NON-JAB'>NON-JAB</option>`;

            $("#lecturer-data_length").append(filterByStudyProgram);
            $("#lecturer-data_filter").prepend(filterByLecturship)
            $("#filter-homebase").change(function () {
                lecturerData.draw();
            });
            $("#filter-lecturship").change(function (){
                lecturerData.draw();
            });
        })
    </script>
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
                    <a href="{{ route('lecturers.export') }}" class="btn btn-sm btn-success" target="_blank" rel="noreferrer">
                        <i class="fa fa-file-export"></i>
                        <span>Export Data</span>
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="lecturer-data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
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
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
