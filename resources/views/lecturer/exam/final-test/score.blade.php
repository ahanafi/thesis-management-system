@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Jadwal Pengujian Skripsi</h2>
        <x-student-thesis-info
            name="{{ $submission->thesis->student->getName() }}"
            nim="{{ $submission->thesis->student->nim }}"
            study-program-name="{{ $submission->thesis->student->study_program->name }}"
            semester="{{ $submission->thesis->student->semester }}"
            avatar="{{ $submission->thesis->student->user->avatar }}"
            research-title="{{ $submission->thesis->research_title }}"
            science-field-name="{{ $submission->thesis->scienceField->name }}"
            first-supervisor="{{ $submission->thesis->firstSupervisor->getNameWithDegree() }}"
            second-supervisor="{{ $submission->thesis->secondSupervisor->getNameWithDegree() }}"
        ></x-student-thesis-info>

        <div class="row">
            <div class="col-xl-7">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Form Input
                            Nilai {!! \App\Constants\AssessmentTypes::getLabel($submission->assessment_type, true) !!}
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('lecturer.exam.final-test.index') }}" text="Kembali"
                                           icon="arrow-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        @if($scores !== null && count($scores) > 0)
                            <table class="table table-bordered table-striped table-vcenter table-sm">
                                <thead>
                                <tr>
                                    <th width="50" class="text-center">#</th>
                                    <th>Komponen Nilai</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($scores as $score)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration  }}</td>
                                        <td class="font-weight-bold">{{ $score->components->name }}</td>
                                        <td class="text-center">{{ $score->score }}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        @else
                            <form action="{{ route('lecturer.exam.final-test.score', $submission->id) }}"
                                  method="POST">
                                @csrf
                                @method('POST')
                                <div class="row push">
                                    <div class="col-lg-10 col-xl-10">

                                        @forelse($components as $component)
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-6 col-form-label text-right">
                                                    {{ ucwords($component->name) }}
                                                </label>

                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control "
                                                           name="scores[{{ $loop->iteration }}]"
                                                           placeholder="Nilai Max : {{ $component->weight }}"
                                                           required="required">
                                                    <input type="hidden" name="component_ids[{{ $loop->iteration }}]"
                                                           value="{{ $component->id }}">

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
                                            <div class="col-sm-6 offset-sm-6">
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
                        @endif
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
