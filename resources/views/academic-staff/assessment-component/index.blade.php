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
            Komponen Nilai
        </h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-layer-group text-muted mr-1"></i>
                    Data Komponen Nilai
                </h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addAssessmentComponent()">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>
            <div class="overflow-hidden" style="padding-left: 1.25rem;padding-right: 1.25rem;margin-bottom: 0;padding-top: 1.25rem;">
                <div id="dm-add-server" class="block block-rounded bg-body-dark animated fadeIn {{ $errors->has('name') || $errors->has('assessment_type') || $errors->has('weight') ? 'd-block' : 'd-none' }}">
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
                        <form action="{{ route('assessment-components.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group row gutters-tiny mb-0 items-push">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama komponen nilai" autocomplete="off" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select" id="example-hosting-vps" name="assessment_type" required>
                                        <option value="">-- Pilih Jenis Pengujain --</option>
                                        @foreach(getTypeOfAssessment() as $type => $label)
                                            <option {{ old('assessment_type') === $type ? 'selected' : '' }} value="{{ $type }}">
                                                {{ strtoupper($label) }} SKRIPSI
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('assessment_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="weight" value="{{ old('weight') }}" placeholder="Bobot nilai" autocomplete="off" required min="5">

                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
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
                        <th>Nama Komponen Nilai</th>
                        <th class="d-none d-sm-table-cell">Jenis Ujian</th>
                        <th class="text-center" style="width: 200px;">Bobot Nilai</th>
                        <th style="width: 15%;" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($assessmentComponents as $component)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $component->name }}</td>
                            <td class="font-w600">{!! getTypeOfAssessment($component->assessment_type) !!}</td>
                            <td class="text-center">{{ $component->weight }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary js-tooltip-enabled"
                                            data-toggle="tooltip"
                                            title=""
                                            onclick="editAssessmentComponent(
                                                    '{{ $component->id }}',
                                                    '{{ $component->name }}',
                                                    '{{ $component->assessment_type }}',
                                                    '{{ $component->weight }}'
                                                )"
                                            data-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="Delete"
                                            onclick="confirmDelete('academic-staff/assessment-components', '{{ $component->id }}')"
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
