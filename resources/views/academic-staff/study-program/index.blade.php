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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Program Studi</h1>
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
                <h3 class="block-title">Data Program Studi</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addStudyProgram()">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>
            <div class="overflow-hidden" style="padding-left: 1.25rem;padding-right: 1.25rem;margin-bottom: 0;padding-top: 1.25rem;">
                <div id="dm-add-server" class="block block-rounded bg-body-dark animated fadeIn d-none mb-0">
                    <div class="block-header bg-white-25">
                        <h3 class="block-title">Tambah Data</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-question"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('study-programs.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group row gutters-tiny mb-0 items-push">
                                <div class="col-md-2">
                                    <x-input type="text" field="study_program_code" placeholder="Kode Prodi" is-required="true"></x-input>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select" name="level">
                                        <option value="">- Pilih Jenjang -</option>
                                        @foreach(educationLevel() as $level)
                                            <option value="{{ $level }}">
                                                {{ $level }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 offset-1">
                                    <select class="custom-select" name="faculty_code" required>
                                        <option value="">-- Pilih Fakultas --</option>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->faculty_code }}">
                                                {{ $faculty->faculty_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row gutters-tiny mb-0 items-push">
                                <div class="col-md-4">
                                    <x-input type="text" field="name" placeholder="Nama Program Studi" is-required="true"></x-input>
                                </div>
                                <div class="col-md-4 offset-1">
                                    <select class="custom-select" name="lecturer_code">
                                        <option value="">-- Pilih Kaprodi --</option>
                                        @foreach($lecturers as $lecturer)
                                            <option value="{{ $lecturer->nidn }}">
                                                {{ $lecturer->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-save mr-1"></i>
                                        <span>Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th class="text-center" style="width: 100px;">Kode</th>
                        <th class="text-center" style="width: 100px;">Jenjang</th>
                        <th>Nama Program Studi</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Kaprodi</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($studyPrograms as $studyProgram)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $studyProgram->study_program_code }}</td>
                            <td class="text-center">{{ $studyProgram->level }}</td>
                            <td class="font-w600">{{ $studyProgram->name }}</td>
                            <td class="d-none d-sm-table-cell">
                                @if($studyProgram->leader)
                                    <a href="{{ route('lecturers.show', $studyProgram->leader->id) }}">{{ $studyProgram->leader->getNameWithDegree() }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip" title=""
                                            onclick="editStudyProgram(
                                                    '{{ $studyProgram->id }}',
                                                    '{{ $studyProgram->study_program_code }}',
                                                    '{{ $studyProgram->name }}',
                                                    '{{ $studyProgram->level }}',
                                                    '{{ $studyProgram->faculty_code }}',
                                                    '{{ $studyProgram->lecturer_code }}'
                                                )"
                                            data-original-title="Edit"
                                    >
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="Delete"
                                            onclick="confirmDelete('master/study-programs', '{{ $studyProgram->id }}')"
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
