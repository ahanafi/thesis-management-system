@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Jadwal Pengujian Skripsi</h2>
        <div class="row">
            <div class="col-xl-6">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-calendar-alt"></i>
                            Detail Jadwal {{ getTypeOfAssessment(strtoupper($schedule->submission->assessment_type)) }}
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('assessment-schedules.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Jenis Ujian</td>
                                <td>:</td>
                                <td>{!! \App\Constants\AssessmentTypes::getLabel($schedule->submission->assessment_type) !!}</td>
                            </tr>
                            <tr>
                                <td width="180">Tanggal Ujian</td>
                                <td>:</td>
                                <td>{{ idDateFormat($schedule->date) }}</td>
                            </tr>
                            <tr>
                                <td width="180">Waktu</td>
                                <td>:</td>
                                <td>{{ $schedule->getAssessmentTime() }}</td>
                            </tr>
                            <tr>
                                <td width="180">Ruang Ujian</td>
                                <td>:</td>
                                <td>
                                    {{ $schedule->room_number }}
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Penguji 1</td>
                                <td>:</td>
                                <td>{{ $schedule->submission->firstExaminer->getNameWithDegree() }}</td>
                            </tr>
                            <tr>
                                <td width="180">Penguji 2</td>
                                <td>:</td>
                                <td>{{ $schedule->submission->secondExaminer->getNameWithDegree() }}</td>
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
                                <td id="std-name">{{ $schedule->submission->thesis->student->getName() }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td id="std-nim">{{ $schedule->submission->nim }}</td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td id="std-study-program">{{ $schedule->submission->thesis->student->study_program->getName() }}</td>
                            </tr>
                            <tr>
                                <td>Judul Skripsi</td>
                                <td>:</td>
                                <td id="std-research-title">{{ $schedule->submission->thesis->research_title }}</td>
                            </tr>
                            <tr>
                                <td>Bidang Ilmu</td>
                                <td>:</td>
                                <td id="std-science-field">{{ $schedule->submission->thesis->scienceField->name }}</td>
                            </tr>
                            <tr>
                                <td>Pembimbing 1</td>
                                <td>:</td>
                                <td id="std-first-supervisor">
                                    {{ $schedule->submission->thesis->firstSupervisor->getNameWithDegree() }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pembimbing 2</td>
                                <td>:</td>
                                <td id="std-second-supervisor">
                                    {{ $schedule->submission->thesis->secondSupervisor->getNameWithDegree() }}
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
