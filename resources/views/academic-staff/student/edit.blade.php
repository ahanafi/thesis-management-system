@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Mahasiswa</h1>
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
    <div class="content content-full content-boxed">
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> Form Mahasiswa
                    </h2>
                    <div class="row push">
                        <div class="col-lg-6 col-xl-6">
                            <x-input-horizontal type="text" field="nim" value="{{ $student->nim }}" placeholder="Masukkan nomor induk" label="NIM"
                                                is-required="true"></x-input-horizontal>

                            <x-input-horizontal type="text" field="full_name" value="{{ $student->full_name }}" placeholder="Masukkan nama lengkap..."
                                                label="Nama Lengkap" is-required="true"></x-input-horizontal>

                            <x-input-horizontal type="text" field="place_of_birth" value="{{ $student->place_of_birth }}" placeholder="Tempat Lahir"
                                                label="Tempat Lahir"></x-input-horizontal>

                            <x-input-horizontal type="date" field="date_of_birth" value="{{ $student->date_of_birth }}" placeholder="Tanggal Lahir"
                                                label="Tanggal Lahir"></x-input-horizontal>

                            <x-input-horizontal type="textarea" field="address" value="{{ $student->address }}" placeholder="Alamat"
                                                label="Alamat"></x-input-horizontal>

                            <div class="form-group row">
                                <label for="gender" class="col-sm-4">
                                    Jenis Kelamin
                                </label>
                                <div class="col-sm-7">
                                    <x-input-radio label="Laki-laki" name="gender" checked="{{ $student->gender }}" value="male"></x-input-radio>
                                    <x-input-radio label="Perempuan" name="gender" checked="{{ $student->gender }}" value="female"></x-input-radio>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group row">
                                <label for="phone" class="col-form-label col-sm-4">No. Telpon</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                +62
                                            </span>
                                        </div>
                                        <input type="telp" class="form-control" id="phone" name="phone"
                                               autocomplete="off" placeholder="812345xxx..." value="{{ $student->phone }}">
                                    </div>
                                </div>
                            </div>

                            <x-input-horizontal type="email" field="email" value="{{ $student->email }}" placeholder="Alamat email" label="Email"
                                                is-required="true"></x-input-horizontal>

                            <div class="form-group row">
                                <label for="study_program_code" class="col-sm-4 col-form-label">
                                    Program Studi
                                </label>
                                <div class="col-sm-7">
                                    <select class="custom-select" name="study_program_code" required>
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach($studyPrograms as $studyProgram)
                                            <option
                                                value="{{ $studyProgram->study_program_code }}"
                                                @if($studyProgram->study_program_code === $student->study_program_code) selected="selected" @endif
                                            >
                                                {{ $studyProgram->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                                <div class="col-sm-7">
                                    <select class="custom-select" name="semester" required>
                                        <option value="">-- Pilih Semester --</option>
                                        @for($i=1; $i<=8; $i++)
                                            <option
                                                @if($i == $student->semester) selected="selected" @endif
                                                value="{{ $i }}">
                                                Semester {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-sm-4">
                                    Foto
                                </label>
                                <div class="col-sm-7">
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" id="dm-profile-edit-avatar"
                                               name="avatar" accept="image/*">
                                        <label class="custom-file-label" for="dm-profile-edit-avatar">Pilih
                                            gambar</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-7 offset-sm-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1"></i>
                                        <span>Simpan</span>
                                    </button>
                                    <button type="reset"
                                            class="btn btn-light btn-secondary float-right btn-outline-secondary">
                                        <i class="fa fa-redo-alt mr-1"></i>
                                        <span>Reset</span>
                                    </button>
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
