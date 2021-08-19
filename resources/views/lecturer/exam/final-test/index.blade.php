@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
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
        <h2 class="content-heading">Data Pengujian Sidang Skripsi</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daftar Mahasiswa Peserta Sidang Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center align-middle" rowspan="2">No.</th>
                        <th class="text-center align-middle" rowspan="2">NIM</th>
                        <th class="text-center align-middle" rowspan="2">Nama Mahasiswa</th>
                        <th colspan="3" class="text-center">Jadwal</th>
                        <th class="text-center align-middle" rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Waktu</th>
                        <th class="text-center">Ruangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($submissions as $submission)
                        @if ($submission->schedule !== null)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $submission->nim }}</td>
                                <td>{{ $submission->thesis->student->getName() }}</td>
                                <td class="text-center">{{ $submission->schedule->date }}</td>
                                <td class="text-center">{{ $submission->schedule->getAssessmentTime() }}</td>
                                <td class="text-center">{{ $submission->schedule->room_number }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lecturer.exam.final-test.show', $submission->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-fw fa-search-plus"></i>
                                        <span>Detail</span>
                                    </a>
                                    <a href="{{ route('lecturer.exam.final-test.score', $submission->id) }}"
                                       class="btn btn-success btn-sm">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                        <span>Nilai</span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
