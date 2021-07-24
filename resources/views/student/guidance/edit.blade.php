@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function(){ Dashmix.helpers('summernote'); });</script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Bimbingan Skripsi
        </h2>
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('student.guidance.update', $guidance->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-comments text-muted mr-1"></i> Form Bimbingan
                    </h2>
                    <div class="row push">
                        <div class="col-lg-10 col-xl-10">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Judul Bimbingan
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " name="title"
                                           placeholder="Masukkan judul bimbingan" value="{{ $guidance->title }}" autocomplete="off"
                                           required="required">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="note" class="col-sm-3 col-form-label text-right">Keterangan</label>

                                <div class="col-sm-9">
                                    <textarea name="note" placeholder="Keterangan" required rows="3" class="js-summernote">{{ $guidance->note }}</textarea>

                                    @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label text-right">
                                    Tanggal
                                </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control " name="date"
                                           value="{{ date('Y-m-d') }}" required="required">

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-sm-3 text-right">
                                    Dokumen Laporan
                                </label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" id="dm-profile-edit-avatar"
                                               name="document">
                                        <label class="custom-file-label" for="dm-profile-edit-avatar">Pilih dokumen</label>
                                    </div>

                                    @error('document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="supervisor" class="col-sm-3 col-form-label text-right">
                                    Dosen Pembimbing
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="supervisor_name" value="{{ $supervisorName }}" class="form-control" readonly disabled>
                                    <input type="hidden" id="supervisor" name="supervisor" value="{{ $guidance->nidn }}">

                                    @error('supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1"></i>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                    <x-button-link extend-class="float-right" type="secondary"
                                       link="{{ route('student.guidance.index') }}" icon="chevron-left"
                                       text="Kembali"></x-button-link>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END User Profile -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
