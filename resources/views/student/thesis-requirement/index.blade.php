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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Persyaratan Skripsi</h1>
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
        <div class="row row-deck">
            <div class="col-sm-7">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-upload text-muted mr-1"></i>
                            Unggah Persyaratan Skripsi
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-4">
                            <form action="{{ route('student.thesis-requirement.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="thesis_requirement_id">Jenis Dokumen</label>
                                    <select class="custom-select" name="thesis_requirement_id" required>
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        @foreach($thesisRequirements as $requirement)
                                            <option value="{{ $requirement->id }}">
                                                {{ $requirement->document_name }}
                                                ({{ documentTypes($requirement->document_type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="document">File</label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" id="dm-profile-edit-file"
                                               name="document" required>
                                        <label class="custom-file-label" for="dm-profile-edit-file">Pilih file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-save"></i>
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <i class="fa fa-fw fa-check-double text-muted mr-1"></i>
                        <h3 class="block-title">Status Unggahan Dokumen</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul list-icons">
                            @foreach ($thesisRequirements as $requirement)
                            <li>
                                <span class="fa-li text-success">
                                    <i class="fa fa-check-circle"></i>
                                </span>
                                <div class="font-w600">{{ $requirement->document_name }}</div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Persyaratan Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Nama Dokumen</th>
                        <th class="d-none d-sm-table-cell">Nama file</th>
                        <th class="text-center" style="width: 200px;">Tanggal Upload</th>
                        <th style="width: 15%;">Aksi</th>
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
