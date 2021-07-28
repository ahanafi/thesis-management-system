@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Bimbingan Skripsi
        </h2>
        @if(!is_null($seminarSubmission) && !$seminarSubmission->isApproved())
            <div class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                 role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0">
                        Anda belum bisa mengajukan Kolokium Skripsi, karena Anda belum mengikuti kegiatan Ujian Seminar
                        Skripsi.
                        <br> <b><i><u>Silahkan selesaikan proses Seminar Skripsi terlebih dahulu.</u></i></b>
                    </p>
                </div>
            </div>
        @endif
        <div class="block block-rounded">
            <div class="block-content">
                <!-- User Profile -->
                <h2 class="content-heading pt-0">
                    <i class="fa fa-fw fa-paper-plane text-muted mr-1"></i> Form Pengajuan Kolokium Skripsi
                </h2>
                <div class="row push">
                    <div class="col-lg-10 col-xl-10">

                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label text-right">
                                NIM
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="student_id"
                                       placeholder="Nomor Induk Mahasiswa" value="{{ $thesis->nim }}"
                                       autocomplete="off"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label text-right">
                                Nama Lengkap
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="student_name"
                                       placeholder="Nama Lengkap" value="{{ $thesis->student->getName() }}"
                                       autocomplete="off"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label text-right">Judul Skripsi</label>

                            <div class="col-sm-9">
                                    <textarea name="note" placeholder="Judul Skripsi" required rows="3" readonly
                                              class="form-control">{{ $thesis->research_title }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label text-right">
                                Pembimbing 1
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="date" readonly
                                       value="{{ $thesis->firstSupervisor->getNameWithDegree() }}"
                                       required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label text-right">
                                Pembimbing 2
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " name="date" readonly
                                       value="{{ $thesis->secondSupervisor->getNameWithDegree() }}"
                                       required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label text-right">
                                Tanggal Pengajuan
                            </label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control " name="date" readonly
                                       value="{{ date('Y-m-d') }}" required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 offset-sm-3">
                                @if(!is_null($seminarSubmission) && !$seminarSubmission->isApproved())
                                    <x-button-link type="secondary btn-block"
                                                   link="{{ route('student.assessment.colloquium.index') }}"
                                                   icon="chevron-left"
                                                   text="Kembali"></x-button-link>
                                @else
                                    <form action="{{ route('student.assessment.colloquium.apply') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="student_id" value="{{ $thesis->nim }}" required>
                                        <input type="hidden" name="thesis_id" value="{{ $thesis->id }}" required>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save mr-1"></i>
                                            <span>Simpan</span>
                                        </button>
                                        <x-button-link extend-class="float-right" type="secondary"
                                                       link="{{ route('student.assessment.colloquium.index') }}"
                                                       icon="chevron-left"
                                                       text="Kembali"></x-button-link>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END User Profile -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
