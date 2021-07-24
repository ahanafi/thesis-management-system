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
        <h2 class="content-heading">Pengajuan Proposal Skripsi</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-alt js-tabs-enabled" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') === null ? 'active' : '' }}"
                       href="{{ route('leader.thesis-submission.index') }}">
                        BELUM DIRESPON
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') === 'approve' ? 'active' : '' }}"
                       href="{{ route('leader.thesis-submission.index', ['status' => 'approve']) }}">
                        DITERIMA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('status') === 'reject' ? 'active' : '' }}"
                       href="{{ route('leader.thesis-submission.index', ['status' => 'reject']) }}">
                        DITOLAK
                    </a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" role="tabpanel">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th class="d-none d-sm-table-cell">Judul Skripsi</th>
                            <th class="d-none d-sm-table-cell">Bidang</th>
                            <th class="text-center" style="width: 200px;">Tanggal Upload</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($thesisSubmission as $submission)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $submission->student->nim }}</td>
                                <td>{{ $submission->student->getName() }}</td>
                                <td>{{ $submission->research_title }}</td>
                                <td>{{ $submission->scienceField->name }}</td>
                                <td>{{ $submission->date_of_filling }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('leader.thesis-submission.show', $submission->id) }}"
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
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
