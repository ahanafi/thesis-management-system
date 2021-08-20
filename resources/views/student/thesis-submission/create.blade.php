@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Proposal Skripsi
        </h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-upload text-muted mr-1"></i>
                            Unggah Proposal Skripsi
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row justify-content-center px-lg-5 py-sm-3 py-md-4">
                            <form action="{{ route('student.thesis-submission.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <x-input type="textarea" field="title" label="judul penelitian"
                                         placeholder="Judul penelitian..." value="{{ old('title') }}"
                                         is-required="true"></x-input>

                                <div class="form-group">
                                    <label for="science_field_id">
                                        Bidang Ilmu Penelitian <span class="text-danger">*</span>
                                    </label>
                                    <select class="custom-select" name="science_field_id" required>
                                        <option value="">-- Pilih Bidang Ilmu --</option>
                                        @foreach($scienceFields as $field)
                                            <option
                                                {{ old('science_field_id') === $field->id ? 'selected' : '' }} value="{{ $field->id }}">
                                                ({{ $field->code }}) {{ $field->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('science_field_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="document">
                                        File Proposal Skripsi <span class="text-danger">*</span>
                                    </label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" id="dm-profile-edit-file" onchange="getFileName(this)"
                                               name="file" required>
                                        <label class="custom-file-label" for="file">Pilih file</label>
                                    </div>
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <x-alert type="info" icon="fa-exclamation-circle"
                                             message="Format dokumen: <b>Doc/Docx, PDF</b>, Max. Ukuran 2MB"
                                    ></x-alert>

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
            <div class="col-sm-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-book-open text-muted mr-1"></i>
                            Panduan
                        </h3>
                    </div>
                    <div class="block-content">
                        <ol class="list-simple-mini">
                            <li>Pastikan Anda telah mengunggah persyaratan untuk mengajukan skripsi.</li>
                            <li>Silahkan buat dokumen proposal penelitian Anda.</li>
                            <li>Isikan semua form input yang tersedia disamping.</li>
                            <li>Semua form input <b>wajib</b> diisi.</li>
                            <li>Format dokumen yang didukung adalah <b>Doc, Docx dan Pdf</b>.</li>
                            <li>Setelah Anda menekan tombol <b>Upload</b>, dokumen proposal Anda akan diteruskan
                                kepada masing-masing Program Studi.
                            </li>
                            <li>Tunggu informasi selanjutnya via email setelah Prodi memberikan tanggapan proposal
                                penelitian yang Anda ajukan.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
