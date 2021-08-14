@extends('layouts.backend')

@section('content')
   <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Detail Proposal Skripsi</h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Pengajuan Proposal Skripsi</h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('student.thesis-submission.index') }}" text="Kembali"
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
                                    <a href="{{ route('student.thesis-submission.download-proposal', $submission->id) }}"
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
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $submission->student->getName() }}"
                    nim="{{ $submission->student->nim }}"
                    study-program-name="{{ $submission->student->study_program->name }}"
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
