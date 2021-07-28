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
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Pengajuan Seminar Skripsi</h2>
        @if(is_null($submission))
            <div class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                 role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0">
                        Anda belum melakukan pengajuan untuk mengikuti kegiatan Seminar Skripsi. Silahkan klik <a
                            href="{{ route('student.assessment.seminar.submission') }}"
                            class="alert-link"><b><u>disini</u></b></a> untuk membuat pengajuan Seminar Skripsi.
                    </p>
                </div>
            </div>
    @endif
    <!-- Start Card Status Pengajuan Seminar Skripsi -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                    Status Pengajuan Seminar Skripsi
                </h3>
                <div class="block-options">
                    <a href="{{ route('student.assessment.seminar.submission') }}" class="btn btn-primary btn-sm @if(!is_null($submission)) disabled @endif">
                        <i class="fa fa-plus"></i>
                        <span>Buat Pengajuan</span>
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-vcenter table-striped">
                        <thead>
                        <tr>
                            <th class="text-center align-middle" rowspan="2">Tanggal Pengajuan</th>
                            <th class="text-center align-middle" colspan="2">Status Pengajuan</th>
                            <th class="text-center align-middle" colspan="2">Tanggal Respons</th>
                            <th class="text-center align-middle" rowspan="2">Laporan</th>
                            <th class="text-center align-middle" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">Pembimbing 1</th>
                            <th class="text-center align-middle">Pembimbing 2</th>
                            <th class="text-center align-middle">Pembimbing 1</th>
                            <th class="text-center align-middle">Pembimbing 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($submission)
                            <tr>
                                <td class="text-center">{{ $submission->created_at ? $submission->created_at->format('d-m-Y') : '-' }}</td>
                                <td class="text-center">{!! $submission ? \App\Constants\Status::getLabel($submission->status_first_supervisor) : '-'  !!}</td>
                                <td class="text-center">{!! $submission ? \App\Constants\Status::getLabel($submission->status_second_supervisor) : '-'  !!}</td>
                                <td class="text-center">{{ $submission->response_date_first_supervisor ?: '-' }}</td>
                                <td class="text-center">{{ $submission->response_date_second_supervisor ?: '-' }}</td>
                                <td class="text-center">
                                    @if($submission->document && Storage::exists($submission->document))
                                        <a href="{{ route('student.assessment.seminar.submission.download', [
                                        'submission' => $submission->id,
                                        'type' => 'report'
                                    ]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-file-download"></i>
                                            <span>Unduh</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($submission->id)
                                        <a href="{{ route('student.assessment.seminar.submission.show', $submission->id) }}"
                                           class="btn btn-sm btn-success">
                                            <i class="fa fa-fw fa-search-plus"></i>
                                            <span>Detail</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-center font-italic" colspan="7">
                                    <b>Pengajuan Seminar Skripsi tidak ditemukan.</b>
                                </td>
                            </tr>
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Card Status Pengajuan Seminar Skripsi -->

        <!-- Start Card Jadwal Seminar Skripsi -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-calendar-alt text-muted mr-1"></i>
                    Jadwal Seminar Skripsi
                </h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-vcenter table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Tanggal</th>
                            <th rowspan="2" class="text-center align-middle">Waktu</th>
                            <th rowspan="2" class="text-center align-middle">Ruangan</th>
                            <th colspan="2" class="text-center align-middle">Dosen Penguji</th>
                        </tr>
                        <tr>
                            <th class="text-center">Penguji 1</th>
                            <th class="text-center">Penguji 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($submission->schedule)
                            <tr>
                                <td class="text-center">{{ optional($submission->schedule)->date }}</td>
                                <td class="text-center">{{ optional($submission->schedule)->getAssessmentTime() }}</td>
                                <td class="text-center">{{ optional($submission->schedule)->room_number }}</td>
                                <td class="text-center">{{ $submission->first_examiner ? $submission->firstExaminer->getNameWithDegree() : '-' }}</td>
                                <td class="text-center">{{ $submission->second_examiner ? $submission->secondExaminer->getNameWithDegree() : '-' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-center font-italic" colspan="6">
                                    <b>Jadwal belum ditemukan.</b>
                                </td>
                            </tr>
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Card Jadwal Seminar Skripsi -->
    </div>
    <!-- END Page Content -->
@endsection
