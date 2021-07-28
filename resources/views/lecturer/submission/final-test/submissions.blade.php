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
        <h2 class="content-heading">Data Pengajuan Sidang Skripsi</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daftar Mahasiswa Yang Mengajukan Sidang Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal Kirim</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $submission->nim }}</td>
                            <td>{{ $submission->thesis->student->getName() }}</td>
                            <td>{{ $submission->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{!! \App\Constants\Status::getLabel($submission->status) !!}</td>
                            <td class="text-center">
                                <a href="{{ route('lecturer.submission.final-test.show', $submission->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-fw fa-search-plus"></i>
                                    <span>Detail</span>
                                </a>
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
