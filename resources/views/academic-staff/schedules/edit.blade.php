@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/l10n/id.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        jQuery(function () {
            flatpickr('#input-date', {
                minDate: "today",
                locale: 'id'
            });

            flatpickr('#start-time, #finish-time', {
                locale: 'id',
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minTime: "08:00",
                maxTime: "16:00",
            });

            Dashmix.helpers('select2');

        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Jadwal Pengujian Skripsi
        </h2>
        <div class="row">
            <div class="col-xl-7">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-calendar-alt text-muted mr-1"></i>
                            Jadwal {{ getTypeOfAssessment(strtoupper($assessmentType)) }}
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('assessment-schedules.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('assessment-schedules.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Jenis Ujian
                                </label>
                                <div class="col-sm-7">
                                    {!! \App\Constants\AssessmentTypes::getLabel($assessmentType) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Mahasiswa
                                </label>
                                <div class="col-sm-7">
                                    <select onchange="fetchStudentInfo(this)" name="student_id"
                                            class="js-select2 form-control @error('student_id') is-invalid @enderror"
                                            required
                                            data-placeholder="-- Pilih Mahasiswa --">
                                        <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                                        @forelse($submissions as $submission)
                                            <option
                                                {{ $submission->nim === $schedule->submission->nim ? 'selected' : '' }}
                                                value="{{ $submission->nim }}"
                                                data-submission-id="{{ $submission->id }}"
                                            >
                                                {{ $submission->thesis->student->getName() }} -
                                                ( {{ $submission->thesis->student->study_program->getName() }} )
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <input type="hidden" id="submission_id" name="submission_id" required
                                           value="{{ $schedule->submission->id }}">

                                    @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Tanggal Ujian
                                </label>
                                <div class="col-sm-7">
                                    <input type="text"
                                           class="js-flatpickr form-control bg-white @error('date') is-invalid @enderror"
                                           id="input-date" value="{{ $schedule->date }}"
                                           name="date" placeholder="Y-m-d" required>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Waktu Ujian
                                </label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text"
                                               class="form-control bg-white @error('start_time') is-invalid @enderror"
                                               id="start-time" value="{{ $schedule->start_at }}"
                                               name="start_time" placeholder="-- : --">

                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                s.d.
                                            </span>
                                        </div>

                                        <input type="text"
                                               class="form-control bg-white @error('finish_time') is-invalid @enderror"
                                               id="finish-time" value="{{ $schedule->finished_at }}"
                                               name="finish_time" placeholder="-- : --">
                                    </div>
                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('finish_time')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Penguji 1
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="first_examiner" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Penguji 2
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="second_examiner" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label text-right">
                                    Ruang Ujian
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" name="room_number" class="form-control"
                                           placeholder="Nomor Ruangan" value="{{ $schedule->room_number }}">
                                    <input type="hidden" name="assessment_type" value="{{ $assessmentType }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-7 offset-sm-3">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fa fa-fw fa-save"></i>
                                        <span>Simpan Jadwal</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-xl-5">
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
