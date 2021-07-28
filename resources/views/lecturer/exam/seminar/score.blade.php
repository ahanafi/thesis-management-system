@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Jadwal Pengujian Skripsi</h2>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-user text-muted mr-1"></i>
                    Data Skripsi Mahasiswa
                </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </div>
            </div>
            <div class="block-content row row-deck">
                <div class="col-md-2 col-xl-3">
                    <img
                        class="img-fluid rounded mb-sm-3"
                        src="{{
                                Storage::exists($submission->thesis->student->user->avatar)
                                ? Storage::url($submission->thesis->student->user->avatar)
                                : asset('media/avatars/avatar7.jpg')
                            }}"
                        alt="User picture">
                </div>
                <div class="col-md-10 col-xl-9">
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
                            <td id="std-first-supervisor">
                                {{ $submission->thesis->firstSupervisor->getNameWithDegree() }}
                            </td>
                        </tr>
                        <tr>
                            <td>Pembimbing 2</td>
                            <td id="std-second-supervisor">
                                {{ $submission->thesis->secondSupervisor->getNameWithDegree() }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Form Input Nilai
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('lecturer.exam.seminar.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('lecturer.exam.seminar.score', $submission->id) }}"
                              method="POST">
                            @csrf
                            @method('POST')
                            <div class="row push">
                                <div class="col-lg-10 col-xl-10">

                                    @forelse($components as $component)
                                        <div class="form-group row">
                                            <label for="date" class="col-sm-4 col-form-label text-right">
                                                {{ ucwords($component->name) }}
                                            </label>

                                            <div class="col-sm-8">
                                                <input type="number" class="form-control " name="scores[{{ $loop->iteration }}]"
                                                      placeholder="{{ ucwords($component->name) }}" required="required">
                                                <input type="hidden" name="component_ids[{{ $loop->iteration }}]" value="{{ $component->id }}">

                                                @error($component->name)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                    <div class="form-group row">
                                        <div class="col-sm-8 offset-sm-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save mr-1"></i>
                                                <span>Simpan</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END User Profile -->
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-xl-5">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                            Detail Jadwal Ujian
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="180">Jenis Ujian</td>
                                    <td>:</td>
                                    <td>{!! \App\Constants\AssessmentTypes::getLabel($submission->assessment_type) !!}</td>
                                </tr>
                                <tr>
                                    <td width="180">Tanggal Ujian</td>
                                    <td>:</td>
                                    <td>{{ $submission->schedule->date }}</td>
                                </tr>
                                <tr>
                                    <td width="180">Waktu</td>
                                    <td>:</td>
                                    <td>{{ $submission->schedule->getAssessmentTime() }}</td>
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
                                <tr>
                                    <td width="180">Ruang Ujian</td>
                                    <td>:</td>
                                    <td>
                                        {{ $submission->schedule->room_number }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
