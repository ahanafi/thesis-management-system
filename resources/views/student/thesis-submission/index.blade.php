@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Pengajuan Proposal Skripsi</h1>
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
        @if(is_null($submission) || ($submission->details_count <= 3) || $submission->status === App\Status::REJECT)
            <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info" role="alert">
                <div class="flex-fill mr-3">
                    <h3 class="alert-heading font-size-h4 my-2">
                        <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                    </h3>
                    <p class="mb-0">
                        Maaf! Anda belum bisa melakukan pengajuan proposal Skripsi. <br>
                        Harap lengkapi seluruh dokumen
                        <a href="{{ route('student.thesis-requirement.index') }}"
                           class="alert-link font-italic">
                            <u>persyaratan pengajuan skripsi</u>
                        </a>
                        terlebih dahulu!.
                    </p>
                </div>
            </div>
        @elseif($submission->status !== App\Status::APPROVE)
            <div class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-info" role="alert">
                <div class="flex-fill mr-3">
                    <h3 class="alert-heading font-size-h4 my-2">
                        <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                    </h3>
                    <p class="mb-0">
                        Mohon menunggu, BAAK sedang <b>memverifikasi</b> dokumen persyaratan skripsi yang telah Anda unggah.
                        <br>
                        Kami akan mengirim notifikasi via email Anda untuk memperbarui status verifikasi dokumen Anda.
                    </p>
                </div>
            </div>
        @else
            <div class="row row-deck">
                <div class="col-sm-7">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-upload text-muted mr-1"></i>
                                Unggah Proposal Skripsi
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row justify-content-center py-sm-3 py-md-4">
                                <form action="{{ route('student.thesis-submission.upload') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <x-input type="textarea" field="title" label="judul"
                                             placeholder="Judul penelitian..." value="{{ old('title') }}"
                                             is-required="true"></x-input>

                                    <div class="form-group">
                                        <label for="science_field_id">
                                            Bidang Ilmu Penelitian <span class="text-danger">*</span>
                                        </label>
                                        <select class="custom-select" name="science_field_id" required>
                                            <option value="">-- Pilih Bidang Ilmu --</option>
                                            @foreach($scienceFields as $field)
                                                <option {{ old('science_field_id') === $field->id ? 'selected' : '' }} value="{{ $field->id }}">
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
                                                   data-toggle="custom-file-input" id="dm-profile-edit-file"
                                                   name="file" required>
                                            <label class="custom-file-label" for="dm-profile-edit-file">Pilih
                                                file</label>
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
                <div class="col-sm-5">
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
        @endif
    </div>
    <!-- END Page Content -->
@endsection
