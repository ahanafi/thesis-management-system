@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Detail Pengajuan Kolokium Skripsi</h2>
        <x-student-thesis-info
            name="{{ $submission->thesis->student->getName() }}"
            nim="{{ $submission->thesis->student->nim }}"
            study-program-name="{{ $submission->thesis->student->study_program->getComplexName() }}"
            semester="{{ $submission->thesis->student->semester }}"
            avatar="{{ $submission->thesis->student->user->avatar }}"
            research-title="{{ $submission->thesis->research_title }}"
            science-field-name="{{ $submission->thesis->scienceField->name }}"
            first-supervisor="{{ $submission->thesis->firstSupervisor->getNameWithDegree() }}"
            second-supervisor="{{ $submission->thesis->secondSupervisor->getNameWithDegree() }}"
        ></x-student-thesis-info>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                    Detail Pengajuan Kolokium Skripsi
                </h3>
                <div class="block-options">
                    <a href="{{ route('student.assessment.colloquium.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-fw fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td style="width: 15%">Tanggal Pengajuan</td>
                            <td>{{ $submission->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="width: 15%">Status Pengajuan</td>
                            <td>
                                - Pembimbing 1
                                : {!! \App\Constants\Status::getLabel($submission->status_first_supervisor) !!}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                - Pembimbing 2
                                : {!! \App\Constants\Status::getLabel($submission->status_second_supervisor) !!}
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="width: 15%">Tanggal Respons</td>
                            <td>
                                - Pembimbing 1
                                : {{ $submission->response_date_first_supervisor ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                - Pembimbing 2
                                : {{ $submission->response_date_second_supervisor ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
