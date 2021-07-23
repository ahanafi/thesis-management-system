@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Bimbingan</h1>
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
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('student.guidance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-comments text-muted mr-1"></i> Form Bimbingan
                    </h2>
                    <div class="row push">
                        <div class="col-lg-8 col-xl-8 offset-2">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Judul Bimbingan
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control " name="title"
                                           placeholder="Masukkan judul bimbingan" value="{{ old('title') }}" autocomplete="off"
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

                                <div class="col-sm-7">
                                    <textarea name="note" placeholder="Keterangan" required rows="3" class="form-control">{{ old('note') }}</textarea>

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
                                <div class="col-sm-7">
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
                                <div class="col-sm-7">
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" id="dm-profile-edit-avatar"
                                               name="document" required>
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
                                <div class="col-sm-7">
                                    <select name="supervisor" id="supervisor" required class="form-control">
                                        <option disabled selected>-- Pilih Dosen Pembimbing --</option>
                                        <option {{ old('supervisor') === $supervisor->first_supervisor ? 'selected' : '' }} value="{{ $supervisor->first_supervisor }}">{{ $supervisor->firstSupervisor->getNameWithDegree() }}</option>
                                        <option {{ old('supervisor') === $supervisor->second_supervisor ? 'selected' : '' }} value="{{ $supervisor->second_supervisor }}">{{ $supervisor->secondSupervisor->getNameWithDegree() }}</option>
                                        <option value="all">Pilih Keduanya (Pembimbing 1 dan 2)</option>
                                    </select>

                                    @error('supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-7 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1"></i>
                                        <span>Simpan</span>
                                    </button>
                                    <x-button-link extend-class="float-right" type="secondary"
                                                   link="{{ route('students.index') }}" icon="chevron-left"
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
