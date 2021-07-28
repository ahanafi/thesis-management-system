@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>
        jQuery(function () {
            jQuery('#note').summernote({
                height: 160,
                disableDragAndDrop: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Pengajuan Kolokium Skripsi</h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                            Detail Pengajuan Kolokium Skripsi
                        </h3>
                        <div class="block-options">
                            @if($submission->status === \App\Constants\Status::APPLY)
                                <a href="#form-supervisor-response" class="btn btn-sm btn-primary">
                                    <i class="fa fa-fw fa-reply"></i>
                                    <span>Tanggapi</span>
                                </a>
                            @else
                                <a href="#form-supervisor-response" onclick="updateSubmissionAssessmentResponse()"
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                    <span>Edit Tanggapan</span>
                                </a>
                            @endif
                            <x-button-link link="{{ route('lecturer.submission.colloquium.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width: 25%;">Judul Skripsi</td>
                                    <td>{{ $submission->thesis->research_title }}</td>
                                </tr>
                                <tr>
                                    <td>Bidang Ilmu</td>
                                    <td>{{ $submission->thesis->scienceField->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Tanggal Pengajuan</td>
                                    <td>{{ $submission->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pengajuan</td>
                                    <td>
                                        {!! \App\Constants\Status::getLabel($submission->status) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Respons</td>
                                    <td>
                                        {{ $submission->response_date_supervisor ? date_format(date_create($submission->response_date_supervisor), 'd-m-Y H:i:s') : '-' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $submission->thesis->student->getName() }}"
                    nim="{{ $submission->thesis->student->nim }}"
                    study-program-name="{{ $submission->thesis->student->study_program->getName() }}"
                    semester="{{ $submission->thesis->student->semester }}"
                    avatar="{{ $submission->thesis->student->user->avatar }}"
                ></x-student-info>
            </div>
            <div class="col-sm-12 {{ $submission->status !== \App\Constants\Status::APPLY ? 'd-none invisible' : '' }}"
                 id="form-supervisor-response">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-reply"></i>
                            Form Tanggapan Pengajuan Seminar
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('lecturer.submission.colloquium.update', $submission->id) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row push">
                                <div class="col-lg-10 col-xl-10">
                                    <div class="form-group row">
                                        <label for="note" class="col-sm-3 col-form-label text-right">Catatan
                                            (Opsional)</label>

                                        <div class="col-sm-9">
                                            <textarea name="note" id="note" placeholder="Keterangan"
                                                      rows="3">{{ $submission->supervisor_note ?? old('response') }}</textarea>

                                            @error('note')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row items-push mb-0">
                                        <label for="note" class="col-sm-3 col-form-label text-right">Tanggapan</label>

                                        <div class="col-sm-3">
                                            <div class="custom-control custom-block custom-control-success mb-1">
                                                <input type="radio" class="custom-control-input"
                                                       value="{{ \App\Constants\Status::APPROVE }}"
                                                       id="example-rd-custom-block1"
                                                       name="supervisor_response" {{ $submission->supervisor_response !== null && $submission->supervisor_response === \App\Constants\Status::APPROVE ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="example-rd-custom-block1">
                                                    <span class="d-flex align-items-center">
                                                        <i class="fa text-success fa-fw fa-check-circle fa-2x"></i>
                                                        <span class="ml-2">
                                                            <span class="font-w700">Setujui</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>

                                            @error('supervisor_response')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="custom-control custom-block custom-control-danger mb-1">
                                                <input type="radio" class="custom-control-input"
                                                       value="{{ \App\Constants\Status::REJECT }}"
                                                       id="example-rd-custom-block2"
                                                       name="supervisor_response" {{ $submission->supervisor_response !== null && $submission->supervisor_response === \App\Constants\Status::REJECT ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="example-rd-custom-block2">
                                                    <span class="d-flex align-items-center">
                                                        <i class="fa text-danger fa-fw fa-times-circle fa-2x"></i>
                                                        <span class="ml-2">
                                                            <span class="font-w700">Tolak Pengajuan</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3 d-flex justify-content-between">
                                            <input type="hidden" name="supervisor_type"
                                                   value="{{ $submission->supervisor_type }}" required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save mr-1"></i>
                                                <span>Simpan Tanggapan</span>
                                            </button>
                                            @if($submission->status === \App\Constants\Status::APPLY)
                                                <x-button-link type="secondary"
                                                               link="{{ route('lecturer.submission.colloquium.index') }}"
                                                               icon="chevron-left"
                                                               text="Kembali"></x-button-link>
                                            @else
                                                <a href="#" class="btn btn-secondary"
                                                   onclick="updateSubmissionAssessmentResponse()">
                                                    <i class="fa fa-fw fa-undo"></i>
                                                    <span>Batal</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END User Profile -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
