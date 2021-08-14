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

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Penentuan Dosen Penguji Seminar Skripsi
        </h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-users text-muted mr-1"></i>
                    Daftar Mahasiswa Yang Mengajukan Seminar Skripsi
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th class="d-none d-sm-table-cell">Judul Skripsi</th>
                        <th class="d-none d-sm-table-cell">Bidang</th>
                        <th class="text-center" style="width: 200px;">Tanggal <i>Acc.</i></th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($submissionSeminarAssessment as $submission)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $submission->student->nim }}</td>
                            <td>{{ $submission->student->getName() }}</td>
                            <td>{{ $submission->thesis->research_title }}</td>
                            <td>{{ $submission->thesis->scienceField->name }}</td>
                            <td>{{ $submission->thesis->created_at }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('leader.determination.seminar-examiner.set-examiner', $submission->id) }}"
                                       class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
