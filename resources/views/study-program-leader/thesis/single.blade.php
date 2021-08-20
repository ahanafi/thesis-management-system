@extends('layouts.backend')

@section('content')

    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Skripsi &amp; Profil Mahasiswa</h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Data Skripsi</h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('leader.thesis.index') }}" text="Kembali"
                                           icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Judul Skripsi</td>
                                <td>:</td>
                                <td>{{ $thesis->research_title }}</td>
                            </tr>
                            <tr>
                                <td width="180">Bidang Ilmu</td>
                                <td>:</td>
                                <td>{{ $thesis->scienceField->name }}</td>
                            </tr>
                            <tr>
                                <td width="180">Disetujui pada</td>
                                <td>:</td>
                                <td>{{ $thesis->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="align-top" width="180">Pembimbing Skripsi</td>
                                <td>:</td>
                                <td>
                                    - {{ $thesis->firstSupervisor ? $thesis->firstSupervisor->getNameWithDegree() : '-' }}
                                    <br>
                                    - {{ $thesis->secondSupervisor ? $thesis->secondSupervisor->getNameWithDegree() : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top" width="180">Penguji Seminar</td>
                                <td>:</td>
                                <td>
                                    @if ($thesis->assessmentSubmission !== null && countFromArray($thesis->assessmentSubmission, ['assessment_type' => \App\Constants\AssessmentTypes::SEMINAR]) > 0)
                                        @foreach($thesis->assessmentSubmission as $submission)
                                            @if($submission->assessment_type === \App\Constants\AssessmentTypes::SEMINAR)
                                                - {{ optional($submission->firstExaminer)->getNameWithDegree() }} <br>
                                                - {{ optional($submission->secondExaminer)->getNameWithDegree() }}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top" width="180">Penguji Sidang</td>
                                <td>:</td>
                                <td>
                                    @if ($thesis->assessmentSubmission !== null && countFromArray($thesis->assessmentSubmission, ['assessment_type' => \App\Constants\AssessmentTypes::TRIAL]) > 0)
                                        @foreach($thesis->assessmentSubmission as $submission)
                                            @if($submission->assessment_type === \App\Constants\AssessmentTypes::TRIAL)
                                                - {{ optional($submission->firstExaminer)->getNameWithDegree() }} <br>
                                                - {{ optional($submission->secondExaminer)->getNameWithDegree() }}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Dokumen Laporan</td>
                                <td>:</td>
                                <td>
                                    @if($thesis->document !== null && Storage::exists($thesis->document))
                                        <a target="_blank" rel="noreferrer"
                                           href="{{ route('leader.thesis.download', ['thesis' => $thesis->id, 'type' => 'report']) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-download"></i>
                                            <span>Unduh Laporan</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Program Aplikasi</td>
                                <td>:</td>
                                <td>
                                    @if($thesis->application !== null)
                                        @if(Storage::exists($thesis->application))
                                            <a target="_blank" rel="noreferrer"
                                               href="{{ route('leader.thesis.download', ['thesis' => $thesis->id, 'type' => 'app']) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Program</span>
                                            </a>
                                        @else
                                            <a target="_blank" rel="noreferrer"
                                               href="{{ $thesis->application }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Program</span>
                                            </a>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Jurnal Penelitian</td>
                                <td>:</td>
                                <td>
                                    @if($thesis->journal !== null && Storage::exists($thesis->journal))
                                        <a target="_blank" rel="noreferrer"
                                           href="{{ route('leader.thesis.download', ['thesis' => $thesis->id, 'type' => 'journal']) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-download"></i>
                                            <span>Unduh Jurnal</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $thesis->student->getName() }}"
                    nim="{{ $thesis->student->nim }}"
                    study-program-name="{{ $thesis->student->study_program->getComplexName() }}"
                    semester="{{ $thesis->student->semester }}"
                    avatar="{{ $thesis->student->user->avatar }}"
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
