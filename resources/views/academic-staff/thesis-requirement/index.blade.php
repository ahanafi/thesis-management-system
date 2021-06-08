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
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Persyaratan Skripsi</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addThesisRequirement()">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>
            <div class="overflow-hidden" style="padding-left: 1.25rem;padding-right: 1.25rem;margin-bottom: 0;padding-top: 1.25rem;">
                <div id="dm-add-server" class="block block-rounded bg-body-dark animated fadeIn d-none">
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
                        <form action="{{ route('thesis-requirements.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group row gutters-tiny mb-0 items-push">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="document_name" value="{{ old('document_name') }}" placeholder="Nama dokumen..." autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select" id="example-hosting-vps" name="document_type" required>
                                        <option value="">-- Pilih Tipe Dokumen --</option>
                                        @foreach(documentTypes() as $type => $label)
                                            <option value="{{ $type }}">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="note" value="{{ old('note') }}" placeholder="Keterangan tambahan (opsional)" autocomplete="off">
                                </div>
                                <div class="col-md-1">
                                    <div class="custom-control custom-checkbox custom-checkbox-square custom-control-lg custom-control-dark mb-1 mt-2">
                                        <input type="checkbox" class="custom-control-input bg-white" id="is-required" name="is-required" checked="checked" onclick="toggleIsRequired()">
                                        <label class="custom-control-label" for="is-required">Wajib</label>
                                    </div>
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
                        <th>Nama Dokumen</th>
                        <th class="d-none d-sm-table-cell">Format</th>
                        <th class="text-center">Sifat</th>
                        <th class="text-center" style="width: 200px;">Keterangan</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($thesisRequirements as $requirement)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $requirement->document_name }}</td>
                            <td class="font-w600">{!! documentTypes($requirement->document_type) !!}</td>
                            <td class="text-center">
                                @if($requirement->is_required)
                                    <span class="badge badge-success">WAJIB</span>
                                @else
                                    <span class="badge badge-warning">OPSIONAL</span>
                                @endif
                            </td>
                            <td class="d-none d-sm-table-cell">{{ $requirement->note }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip"
                                            title=""
                                            onclick="editThesisRequirement(
                                                    '{{ $requirement->id }}',
                                                    '{{ $requirement->document_name }}',
                                                    '{{ $requirement->document_type }}',
                                                    '{{ $requirement->is_required }}',
                                                    '{{ $requirement->note }}'
                                                )"
                                            data-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="Delete"
                                            onclick="confirmDelete('thesis-requirements', '{{ $requirement->id }}')"
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
