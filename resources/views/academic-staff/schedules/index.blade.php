@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        jQuery(function () {
            Dashmix.helpers('flatpickr');
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
            <div class="col-lg-12">
                <!-- Block Tabs With Button Options Default Style -->
                <div class="block block-rounded">
                    <ul class="nav nav-tabs nav-tabs-block align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ $assessmentType === 'seminar' ? 'active' : '' }}" href="{{ route('assessment-schedules.index', ['type' => 'seminar']) }}">Seminar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $assessmentType === 'colloquium' ? 'active' : '' }}" href="{{ route('assessment-schedules.index', ['type' => 'colloquium']) }}">Kolokium</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $assessmentType === 'final-test' ? 'active' : '' }}" href="{{ route('assessment-schedules.index', ['type' => 'final-test']) }}">Sidang</a>
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
                                        <a class="dropdown-item" href="#" onclick="window.location.href='{{ route('assessment-schedules.create') }}?type=seminar'">
                                            <i class="fa fa-fw fa-arrow-right mr-1"></i>
                                            <span>Seminar</span>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="window.location.href='{{ route('assessment-schedules.create') }}?type=colloquium'">
                                            <i class="fa fa-fw fa-arrow-right mr-1"></i>
                                            <span>Kolokium</span>
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="window.location.href='{{ route('assessment-schedules.create') }}?type=final-test'">
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
                            <table class="table table-bordered table-striped table-vcenter">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 80px;">#</th>
                                    <th>Nama Mahasiswa</th>
                                    <th class="text-center">Program Studi</th>
                                    <th class="text-center">Jenis Ujian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
