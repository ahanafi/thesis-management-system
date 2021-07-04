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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Set</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        @if($dataSets->count() <= 0)
            <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                 role="alert">
                <div class="flex-fill mr-3">
                    <h3 class="alert-heading font-size-h4 my-2">
                        <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                    </h3>
                    <p class="mb-0">
                        Silahkan unggah <i>data set</i> terlebih dahulu agar penentuan Dosen Pembimbing dan Dosen
                        Penguji
                        dapat dilakukan. <br>
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-xl-5">
                    <form action="{{ route('leader.data-set.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Upload Data Set</h3>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="col-sm-10 col-md-8">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                       class="custom-file-input js-custom-file-input-enabled"
                                                       data-toggle="custom-file-input" id="dm-profile-edit-avatar"
                                                       name="data-set" required>
                                                <label class="custom-file-label" for="dm-profile-edit-avatar">Pilih
                                                    file</label>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                                    <i class="fa fa-file-import"></i>
                                                    <span>Import</span>
                                                </button>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <button type="submit" class="btn btn-sm btn-success btn-block">
                                                    <i class="fa fa-file-download"></i>
                                                    <span>Unduh Format</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Persyaratan Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Tahun Skripsi</th>
                            <th>Judul</th>
                            <th>Bidang Ilmu</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Penguji Seminar 1</th>
                            <th>Penguji Seminar 2</th>
                            <th>Penguji Sidang 1</th>
                            <th>Penguji Sidang 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($dataSets as $dataSet)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $dataSet->nim }}</td>
                                <td>{{ $dataSet->student_name }}</td>
                                <td>{{ $dataSet->study_program_name }}</td>
                                <td>{{ $dataSet->thesis_year }}</td>
                                <td>
                                    @if($dataSet->research_title !== '-')
                                        <button type="button" class="btn btn-sm btn-primary js-popover"
                                                data-toggle="popover"
                                                data-placement="top"
                                                title="{{ $dataSet->research_title }}"
                                                data-content="{{ $dataSet->research_title }}"
                                                data-original-title="{{ $dataSet->research_title }}">
                                            Hover me.
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $dataSet->science_field_name }}</td>
                                <td>{{ $dataSet->first_supervisor }}</td>
                                <td>{{ $dataSet->second_supervisor }}</td>
                                <td>{{ $dataSet->first_seminar_examiner }}</td>
                                <td>{{ $dataSet->second_seminar_examiner }}</td>
                                <td>{{ $dataSet->first_trial_examiner }}</td>
                                <td>{{ $dataSet->second_trial_examiner }}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
