@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content content-full">
        <h2 class="content-heading">
            Data Dosen
        </h2>
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-users text-muted mr-1"></i> Form Dosen
                    </h2>
                    <div class="row push">
                        <div class="col-lg-6 col-xl-6">
                            <x-input-horizontal type="text" field="nidn" value="{{ $lecturer->nidn }}" placeholder="Masukkan nomor induk" label="NIDN" is-required="true"></x-input-horizontal>

                            <x-input-horizontal type="text" field="full_name" value="{{ $lecturer->full_name }}" placeholder="Masukkan nama lengkap..." label="Nama Lengkap" is-required="true"></x-input-horizontal>

                            <x-input-horizontal type="text" field="degree" value="{{ $lecturer->degree }}" placeholder="Contoh gelar: S.Kom., M.Kom." label="Gelar" is-required="true"></x-input-horizontal>

                            <x-input-horizontal type="email" field="email" value="{{ $lecturer->email }}" placeholder="Alamat email" label="Email" is-required="true"></x-input-horizontal>

                            <div class="form-group row">
                                <label for="phone" class="col-form-label col-sm-4">No. Telpon</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                +62
                                            </span>
                                        </div>
                                        <input type="telp" class="form-control" id="phone" name="phone" autocomplete="off" placeholder="812345xxx...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group row">
                                <label for="gender" class="col-sm-4">
                                    Jenis Kelamin
                                </label>
                                <div class="col-sm-7">
                                    <x-input-radio label="Laki-laki" name="gender" checked="{{ $lecturer->gender === 'M' }}" value="M"></x-input-radio>
                                    <x-input-radio label="Perempuan" name="gender" checked="{{ $lecturer->gender === 'F' }}" value="F"></x-input-radio>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="study_program_code" class="col-sm-4 font-italic">
                                    Homebase
                                </label>
                                <div class="col-sm-7">
                                    <select class="custom-select" name="study_program_code" required>
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach($studyPrograms as $studyProgram)
                                            <option
                                                {{ ($studyProgram->study_program_code == $lecturer->study_program_code) ? 'selected' : '' }}
                                                value="{{ $studyProgram->study_program_code }}">
                                                {{ $studyProgram->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="functional" class="col-sm-4">
                                    Jabtan Fungsional
                                </label>
                                <div class="col-sm-7">
                                    <select class="custom-select" name="functional">
                                        <option value="">-- Pilih Jabtan Fungsional --</option>
                                        @foreach(getLecturship() as $code => $label)
                                            <option
                                                {{ ($code == $lecturer->functional) ? 'selected' : '' }}
                                                value="{{ $code }}">
                                                {{ $label }}
                                            </option>
                                        @endforeach
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
                                        <label class="custom-file-label" for="dm-profile-edit-avatar">Pilih gambar</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-7 offset-sm-4">
                                    <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save mr-1"></i>
                                    <span>Simpan</span>
                                </button>
                                <x-button-link extend-class="float-right" type="secondary" link="{{ route('lecturers.index') }}" icon="chevron-left" text="Kembali"></x-button-link>
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
