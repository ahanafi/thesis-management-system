@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <style>
        .popover .show .bs-popover-top > .popover-body {
            display: none;
            visibility: hidden;
        }
    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script>
        jQuery(function () {
            $("#data-sets").DataTable({
                paging: false,
            });
            $("#data-sets_wrapper > .row:first-child > .col-sm-12:first-child")
        });
    </script>
@endsection

@section('content')<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">Data Set Skripsi</h2>
    @if(is_null($dataSets) || count($dataSets) <= 0 || (request()->has('action') && request()->get('action') === 'import'))
        <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
             role="alert">
            <div class="flex-fill mr-3">
                <h3 class="alert-heading font-size-h4 my-2">
                    <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                </h3>
                <p class="mb-0">
                    Silahkan unggah <i>data set</i> terlebih dahulu agar penentuan Dosen
                    Penguji Sidang dapat dilakukan. <br>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <form action="{{ route('leader.data-set.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Import Data Set</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="close">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </button>
                            </div>
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

                                        @error('data-set')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                                <i class="fa fa-file-import"></i>
                                                <span>Import</span>
                                            </button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <a href="{{ route('download.format.import.data-set') }}"
                                               class="btn btn-success btn-sm btn-block" target="_blank"
                                               rel="noreferrer">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Format</span>
                                            </a>
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
            <h3 class="block-title">Data Set Skripsi Mahasiswa</h3>
            <div class="block-options">
                @if(isset($dataSets) && count($dataSets) > 0)
                    <a href="{{ route('leader.data-set.index') . '?action=import' }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-fw fa-file-import"></i>
                        <span>Import Data Baru</span>
                    </a>
                    <a href="#" onclick="truncateDataSet()" class="btn btn-danger btn-sm">
                        <i class="fa fa-fw fa-trash"></i>
                        <span>Kosongkan</span>
                    </a>
                @endisset
            </div>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive table-responsive-sm">
                <table class="table table-sm table-bordered table-striped table-vcenter" id="data-sets">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Tahun Skripsi</th>
                        <th>Judul</th>
                        <th>Bidang Ilmu</th>
                        {{--<th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Penguji Seminar 1</th>
                        <th>Penguji Seminar 2</th>--}}
                        <th>Penguji Sidang 1</th>
                        <th>Penguji Sidang 2</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dataSets as $dataSet)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $dataSet->nim }}</td>
                            <td>{{ showName($dataSet->student_name) }}</td>
                            <td class="text-center">{{ studyProgramShortName($dataSet->study_program_name) }}</td>
                            <td class="text-center">{{ $dataSet->thesis_year }}</td>
                            <td>
                                @if($dataSet->research_title !== '-')
                                    <span class="badge badge-info js-popover"
                                          data-toggle="popover"
                                          data-placement="top"
                                          title="{{ $dataSet->research_title }}"
                                          data-original-title="{{ $dataSet->research_title }}"
                                    >Lihat Judul</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $dataSet->science_field_name }}</td>
                            {{--                                <td>{{ showName($dataSet->first_supervisor) }}</td>--}}
                            {{--                                <td>{{ showName($dataSet->second_supervisor) }}</td>--}}
                            {{--                                <td>{{ showName($dataSet->first_seminar_examiner) }}</td>--}}
                            {{--                                <td>{{ showName($dataSet->second_seminar_examiner) }}</td>--}}
                            <td>{{ showName($dataSet->first_trial_examiner) }}</td>
                            <td>{{ showName($dataSet->second_trial_examiner) }}</td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if(is_null($dataSets) || count($dataSets) <= 0)
    <form action="{{ route('leader.data-set.destroy') }}" method="POST" id="form-destroy">
        @csrf
        @method('POST')
        <input type="hidden" name="action" value="DESTROY" required>
    </form>
@endif
<!-- END Page Content -->
@endsection
