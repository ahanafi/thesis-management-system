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
    <div class="content content-full">
        <h2 class="content-heading">Data Bidang Ilmu</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-lightbulb"></i>
                    Data Bidang Ilmu
                </h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addScienceField()">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </button>
                    <a href="{{ route('science-fields.import') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-download"></i>
                        <span>Import Data</span>
                    </a>
                </div>
            </div>
            <div class="overflow-hidden"
                 style="padding-left: 1.25rem;padding-right: 1.25rem;margin-bottom: 0;padding-top: 1.25rem;">
                <div id="dm-add-server" class="block block-rounded bg-body-dark animated fadeIn @if($errors->has('name')) d-block @else d-none @endif">
                    <div class="block-header bg-white-25">
                        <h3 class="block-title">Tambah Data</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-question"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('science-fields.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group row gutters-tiny mb-0 items-push">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="code" value="{{ $code }}"
                                           placeholder="Kode Bidang Ilmu" autocomplete="off" readonly required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="example-hosting-name"
                                           value="{{ old('name') }}" name="name" placeholder="Nama Bidang Ilmu">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                        <th>Nama Bidang Ilmu</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($scienceFields as $field)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $field->code }}</td>
                            <td class="font-w600">{{ $field->name }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip" title=""
                                            onclick="editScienceField('{{ $field->id }}', '{{ $field->code }}', '{{ $field->name }}')"
                                            data-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="Delete"
                                            onclick="confirmDelete('academic-staff/master/science-fields', '{{ $field->id }}')"
                                    >
                                        <i class="fa fa-fw fa-trash"></i>
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
