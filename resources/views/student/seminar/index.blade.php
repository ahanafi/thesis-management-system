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
        <h2 class="content-heading">Persyaratan Skripsi</h2>
        <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info" role="alert">
            <div class="flex-fill mr-3">
                <h3 class="alert-heading font-size-h4 my-2">
                    <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                </h3>
                <p class="mb-0">
                    Silahkan unggah dokumen persyaratan untuk mengajukan Skripsi terlebih dahulu. <br>
                    <u>Anda dapat mengajukan Skripsi, setelah Anda mengunggah semua dokumen persyaratan Skripsi di bawah ini.</u>
                </p>
            </div>
        </div>
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
                            <form action="{{ route('student.thesis-requirement.upload') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
