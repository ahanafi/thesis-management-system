@extends('layouts.backend')

@section('content')


    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Data Dosen
        </h2>
        <div class="row row-deck">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-download text-muted mr-1"></i>
                            Impor Data Dosen
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-5">
                            <form action="{{ route('lecturers.import') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="import-data-example">Sample Import Data</label>
                                    <a href="{{ route('download.format.import.lecturer') }}" class="btn btn-success btn-block" target="_blank" rel="noreferrer">
                                        <i class="fa fa-download"></i>
                                        <span>Download Template</span>
                                    </a>
                                </div>

                                <div class="form-group">
                                    <label for="document">File</label>
                                    <div class="custom-file {{ ($errors->has('file')) ? 'is-invalid' : '' }}">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled {{ ($errors->has('file')) ? 'is-invalid' : '' }}"
                                               data-toggle="custom-file-input" id="dm-profile-edit-file" name="file"
                                               required="required">
                                        <label class="custom-file-label" for="dm-profile-edit-file">Pilih file</label>
                                    </div>

                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary btn-block" type="submit">
                                            <i class="fa fa-fw fa-paper-plane"></i>
                                            Upload
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-back-button link="lecturers.index" type="btn-secondary btn-block"></x-back-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection
