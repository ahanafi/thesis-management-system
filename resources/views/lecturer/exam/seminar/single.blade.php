@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Jadwal Pengujian Skripsi</h2>

        @if(is_null($submission->schedule))
            <div class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                 role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0">
                        Jadwal ujian Skripsi ini belum ditentukan oleh BAAK.
                        @if (auth()->user()->level === \App\Models\User::STUDY_PROGRAM_LEADER && $submission->student->study_program_code === auth()->user()->lecturerProfile->study_program_code)
                            Mohon agar <i>follow-up</i> BAAK agar jadwal segera dibuatkan.
                        @elseif(auth()->user()->level === \App\Models\User::LECTURER)
                            Jadwl ujian akan segera dibuat.
                        @endif
                    </p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-6">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-calendar-alt"></i>
                            Detail Jadwal Ujian
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('lecturer.exam.seminar.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Jenis Ujian</td>
                                <td>:</td>
                                <td>{!! \App\Constants\AssessmentTypes::getLabel($submission->assessment_type) !!}</td>
                            </tr>
                            <tr>
                                <td width="180">Tanggal Ujian</td>
                                <td>:</td>
                                <td>{{ $submission->schedule->date ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Waktu</td>
                                <td>:</td>
                                <td>{{ ($submission->schedule) ? $submission->schedule->getAssessmentTime() : '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Ruang Ujian</td>
                                <td>:</td>
                                <td>{{ $submission->schedule->room_number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Penguji 1</td>
                                <td>:</td>
                                <td>{{ $submission->firstExaminer->getNameWithDegree() }}</td>
                            </tr>
                            <tr>
                                <td width="180">Penguji 2</td>
                                <td>:</td>
                                <td>{{ $submission->secondExaminer->getNameWithDegree() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-xl-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-user text-muted mr-1"></i>
                            Data Skripsi Mahasiswa
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="140">Nama Lengkap</td>
                                <td width="10">:</td>
                                <td id="std-name">{{ $submission->thesis->student->getName() }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td id="std-nim">{{ $submission->nim }}</td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td id="std-study-program">{{ $submission->thesis->student->study_program->getName() }}</td>
                            </tr>
                            <tr>
                                <td>Judul Skripsi</td>
                                <td>:</td>
                                <td id="std-research-title">{{ $submission->thesis->research_title }}</td>
                            </tr>
                            <tr>
                                <td>Bidang Ilmu</td>
                                <td>:</td>
                                <td id="std-science-field">{{ $submission->thesis->scienceField->name }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 1</td>
                                <td>:</td>
                                <td id="std-first-supervisor">
                                    {{ $submission->thesis->firstSupervisor->getNameWithDegree() }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pembimbing 2</td>
                                <td>:</td>
                                <td id="std-second-supervisor">
                                    {{ $submission->thesis->secondSupervisor->getNameWithDegree() }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
