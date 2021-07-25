@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Detail Pengajuan Seminar Skripsi</h2>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-book text-muted mr-1"></i>
                    Data Skripsi Mahasiswa
                </h3>
            </div>
            <div class="block-content row">
                <div class="col-md-2 col-xl-2">
                    <img
                        class="img-fluid rounded mb-sm-3"
                        src="{{
                                Storage::exists($submission->thesis->student->user->avatar)
                                ? Storage::url($submission->thesis->student->user->avatar)
                                : asset('media/avatars/avatar7.jpg')
                            }}"
                        alt="User picture">
                </div>
                <div class="col-md-10 col-xl-10">
                    <table class="table table-bordered table-sm table-striped">
                        <tr>
                            <td style="width: 15%">NIM</td>
                            <td>{{ $submission->thesis->student->nim }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>{{ $submission->thesis->student->getName() }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>
                                {{ $submission->thesis->student->study_program->getName() }}
                                - {{ $submission->thesis->student->semester }}
                            </td>
                        </tr>
                        <tr>
                            <td>Judul Skripsi</td>
                            <td>{{ $submission->thesis->research_title }}</td>
                        </tr>
                        <tr>
                            <td>Bidang Ilmu</td>
                            <td>{{ $submission->thesis->scienceField->name }}</td>
                        </tr>
                        <tr>
                            <td>Pembimbing 1</td>
                            <td>{{ $submission->thesis->firstSupervisor->getNameWithDegree() }}</td>
                        </tr>
                        <tr>
                            <td>Pembimbing 2</td>
                            <td>{{ $submission->thesis->secondSupervisor->getNameWithDegree() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                    Detail Pengajuan Seminar Skripsi
                </h3>
                <div class="block-options">
                    <a href="{{ route('student.assessment.seminar.index') }}" class="btn btn-outline-primary btn-sm">
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
                                : {{ $submission->response_date_first_supervisor ? $submission->response_date_first_supervisor->format('d-m-Y H:i:s') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                - Pembimbing 2
                                : {{ $submission->response_date_second_supervisor ? $submission->response_date_second_supervisor->format('d-m-Y H:i:s') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="width: 15%">Kartu Bimbingan</td>
                            <td>
                                - Pembimbing 1 :
                                @if(Storage::exists($submission->guidance_card_first_supervisor))
                                    <a href="{{ $submission->guidance_card_first_supervisor }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-pdf"></i>
                                        <span>Unduh Kartu Bimbingan</span>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                - Pembimbing 2 :
                                @if(Storage::exists($submission->guidance_card_second_supervisor))
                                    <a href="{{ $submission->guidance_card_second_supervisor }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-pdf"></i>
                                        <span>Unduh Kartu Bimbingan</span>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%">Laporan Skripsi</td>
                            <td>
                                @if(Storage::exists($submission->document))
                                    <a href="{{ $submission->document }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-alt"></i>
                                        <span>Unduh Laporan</span>
                                    </a>
                                @else
                                    -
                                @endif
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
