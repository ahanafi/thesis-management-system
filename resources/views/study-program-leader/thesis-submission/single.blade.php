@extends('layouts.backend')

@section('content')
   <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Detail Pengajuan Proposal Skripsi</h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Pengajuan Proposal Skripsi</h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('leader.thesis-submission.index') }}" text="Kembali"
                                           icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                    <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Judul Skripsi</td>
                                <td>:</td>
                                <td>{{ $submission->research_title }}</td>
                            </tr>
                            <tr>
                                <td width="180">Bidang Ilmu</td>
                                <td>:</td>
                                <td>{{ $submission->scienceField->name }}</td>
                            </tr>
                            <tr>
                                <td width="180">Tanggal Pengajuan</td>
                                <td>:</td>
                                <td>{{ $submission->date_of_filling }}</td>
                            </tr>
                            <tr>
                                <td width="180">Dokumen</td>
                                <td>:</td>
                                <td>
                                    <a href="#"
                                       onclick="showDocument(
                                           '{{ Storage::url($submission->document) }}',
                                           '{{ File::extension(Storage::url($submission->document)) }}'
                                           )"
                                       data-toggle="modal" data-target="#modal-detail-document"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-search"></i>
                                        <span>Lihat Detail</span>
                                    </a>
                                    <a href="{{ route('leader.thesis-submission.download-proposal', $submission->id) }}"
                                       class="btn btn-sm btn-secondary">
                                        <i class="fa fa-file-download"></i>
                                        <span>Unduh Dokumen</span>
                                    </a>
                                </td>
                            </tr>
                            @if(!in_array($submission->status, [\App\Constants\Status::WAITING, \App\Constants\Status::APPLY], true))
                                <tr>
                                    <td>Status Proposal</td>
                                    <td>:</td>
                                    <td>{!! \App\Constants\Status::getLabel($submission->status) !!}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Respons</td>
                                    <td>:</td>
                                    <td>{{ $submission->response_date }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ $submission->response_note }}</td>
                                </tr>
                                <tr>
                                    <td>Dokumen Balasan</td>
                                    <td>:</td>
                                    <td>
                                        @if($submission->response_document !== '' && Storage::exists($submission->response_document))
                                            <a href="#"
                                               onclick="showDocument(
                                                   '{{ Storage::url($submission->response_document) }}',
                                                   '{{ File::extension(Storage::url($submission->response_document)) }}'
                                                   )"
                                               data-toggle="modal" data-target="#modal-detail-document"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-search"></i>
                                                <span>Lihat Detail</span>
                                            </a>
                                            <a href="#"
                                               class="btn btn-sm btn-secondary">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Dokumen</span>
                                            </a>
                                        @else - @endif
                                    </td>
                                </tr>
                            @endif
                        </table>
                        <br>
                        @if($submission->status === \App\Constants\Status::APPLY)
                            <h3 class="block-title">Tanggapi Pengajuan Proposal Skripsi</h3>
                            <hr>
                            <form action="{{ route('leader.thesis-submission.submit-response', $submission->id) }}"
                                  method="POST"
                                  id="thesis-submission-response"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="form-group row">
                                    <label for="note" class="col-sm-3 col-form-label">
                                        Catatan <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <textarea
                                            onkeyup="validateNotes(this)"
                                            class="form-control"
                                            id="note"
                                            name="note"
                                            rows="3"
                                            placeholder="Catatan..."
                                            spellcheck="false" required="required"
                                            style="resize: none;"
                                        >{{ old('note') }}</textarea>

                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="avatar" class="col-sm-3">
                                        Dokumen (Opsional)
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                            <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                                   data-toggle="custom-file-input" id="document"
                                                   name="document" onchange="getFileName(this)">
                                            <label class="custom-file-label" for="document">Pilih
                                                dokumen</label>
                                        </div>

                                        @error('document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-8 offset-sm-3">
                                        <button type="button" onclick="submitThesisSubmissionResponse('REJECT')"
                                                class="btn btn-danger">
                                            <i class="fa fa-times"></i>
                                            <span>Tolak Pengajuan</span>
                                        </button>
                                        <button type="button" onclick="submitThesisSubmissionResponse('APPROVE')"
                                                class="btn btn-success">
                                            <i class="fa fa-check"></i>
                                            <span>Terima Pengajuan</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $submission->student->getName() }}"
                    nim="{{ $submission->student->nim }}"
                    study-program-name="{{ $submission->student->getName() }}"
                    semester="{{ $submission->student->semester }}"
                    avatar="{{ $submission->student->user->avatar }}"
                ></x-student-info>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('modal')
    <!-- Slide Up Block Modal -->
    <div class="modal fade" id="modal-detail-document" tabindex="-1" role="dialog"
         aria-labelledby="modal-detail-document"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Detail Dokumen</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content text-center align-middle" id="view"></div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Slide Up Block Modal -->
@endsection
