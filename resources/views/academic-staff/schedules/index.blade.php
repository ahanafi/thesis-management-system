@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Jadwal Pengujian Skripsi
        </h2>
        <div class="row">
            <div class="col-lg-12">
                <!-- Block Tabs With Button Options Default Style -->
                <div class="block block-rounded">
                    <ul class="nav nav-tabs nav-tabs-block align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ $assessmentType === 'seminar' ? 'active' : '' }}"
                               href="{{ url('academic-staff/assessment-schedules/seminar') }}">Seminar Skripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $assessmentType === 'final-test' || strtolower($assessmentType) === 'trial' ? 'active' : '' }}"
                               href="{{ url('academic-staff/assessment-schedules/final-test') }}">Sidang Skripsi</a>
                        </li>
                        <li class="nav-item ml-auto">
                            <div class="btn-group btn-group-sm pr-2">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupTabs1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-fw fa-plus"></i>
                                        <span>Tambah Data</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupTabs1"
                                         style="">
                                        <a class="dropdown-item" href="#"
                                           onclick="window.location.href='{{ route('assessment-schedules.create') }}?type=seminar'">
                                            <i class="fa fa-fw fa-arrow-right mr-1"></i>
                                            <span>Seminar</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           onclick="window.location.href='{{ route('assessment-schedules.create') }}?type=final-test'">
                                            <i class="fa fa-fw fa-arrow-right mr-1"></i>
                                            <span>Sidang</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="seminar" role="tabpanel">
                            <h4 class="font-w400">Jadwal {{ getTypeOfAssessment(strtoupper($assessmentType)) }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th>Nama Mahasiswa</th>
                                        <th class="text-center">Program Studi</th>
                                        <th class="text-center">Penguji</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($schedules as $schedule)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $schedule->submission->thesis->student->getName() }}</td>
                                            <td>{{ $schedule->submission->thesis->student->study_program->name }}</td>
                                            <td>
                                                1) {{ $schedule->submission->firstExaminer->getNameWithDegree() }} <br>
                                                2) {{ $schedule->submission->secondExaminer->getNameWithDegree() }} <br>
                                            </td>
                                            <td class="text-center">{{ idDateFormat($schedule->date) }}</td>
                                            <td class="text-center">{{ $schedule->getAssessmentTime() }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('assessment-schedules.edit', $schedule->id) }}" class="btn btn-primary">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{ route('assessment-schedules.show', $schedule->id) }}" class="btn btn-secondary">
                                                        <i class="fa fa-fw fa-search-plus"></i>
                                                    </a>
                                                    <a href="#" onclick="confirmDelete('academic-staff/assessment-schedules', '{{ $schedule->id }}')" class="btn btn-danger">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Block Tabs With Button Options Default Style -->
            </div>
        </div>
        <!-- END Block Tabs With Options -->
    </div>
    <!-- END Page Content -->
@endsection
